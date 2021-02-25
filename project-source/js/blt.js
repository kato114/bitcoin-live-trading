
(function ($,Pusher) {




    // BLT Controller

    var BLTCtrl = function () {
        var self = this;

        self.removeTradeCallback = null;
        self.addTradeCallback = null;
        self.lastPriceCallback = null;

        self.restoreSession();

        self.trades = [];

        self.connections = {
            gdax: null,
            bitfinex: null,
            bitstamp: null
        };

        self.socket_openers = {
            gdax: function () {
                var conn = self.connections.gdax = new WebSocket('wss://ws-feed.gdax.com');

                conn.onmessage = function(msg){
                    var data = JSON.parse(msg.data);

                    if(data.type == 'match'){
                        self.addTrade('GDAX',new Date(data.time),parseFloat(data.price),parseFloat(data.size),data.side);
                    }
                };

                conn.onopen = function () {
                    conn.send(JSON.stringify({
                        type: 'subscribe',
                        product_ids: ['BTC-USD']
                    }))
                };


            },
            bitstamp: function () {

                var conn = self.connections.bitstamp = self.connections.bitstamp ?
                    self.connections.bitstamp :
                    new Pusher('de504dc5763aeef9ff52');

                var tradesChannel = conn.subscribe('live_trades');

                tradesChannel.bind('trade', function (data) {
                    self.addTrade('Bitstamp',new Date(data.timestamp*1000),data.price,data.amount);
                });


            },
            bitfinex: function () {

                var conn = self.connections.bitfinex = new WebSocket('wss://api.bitfinex.com/ws/2');

                conn.onmessage = function(msg){
                    var data = JSON.parse(msg.data);

                    if(data && data instanceof Array && data[1] == 'tu'){
                        var info = data[2];

                        self.addTrade('Bitfinex',new Date(info[1]),info[3],Math.abs(info[2]));
                    }


                };

                conn.onopen = function () {
                    conn.send(JSON.stringify({
                        event: 'subscribe',
                        channel: 'trades',
                        symbol: 'tBTCUSD'
                    }))
                };


            }
        };

        self.socket_closers = {
            gdax: function () {
                var conn = self.connections.gdax;

                if(conn){
                    conn.close();
                    self.connections.gdax = null;
                }
            },
            bitstamp: function () {
                var conn = self.connections.bitstamp;

                if(conn){
                    conn.unsubscribe('live_trades');
                }

            },
            bitfinex: function () {
                var conn = self.connections.bitfinex;

                if(conn){
                    conn.close();
                    self.connections.bitfinex = null;
                }
            }
        };
    };

    BLTCtrl.prototype.restoreSession = function () {
        if(!this.getStorage()){
            this.options = {
                exchanges: {
                    gdax: true,
                    bitfinex: true,
                    bitstamp: true
                },
                max_trades: 25
            }
        }
    };

    BLTCtrl.prototype.getStorage = function () {
        var udata_json = localStorage.getItem('blt_userdata');

        if(!udata_json)
            return false;

        var udata_obj = JSON.parse(udata_json);

        this.options = udata_obj.options;

        return true;
    };

    BLTCtrl.prototype.saveStorage = function () {
        var self = this;

        localStorage.setItem('blt_userdata', JSON.stringify({
            options: self.options
        }));
    };

    BLTCtrl.prototype.addTrade = function (exchange,date,rate,amount) {

        var trade = {
            exchange: exchange,
            date: date.getTime(),
            clock: moment(date).format('HH:mm:ss'),
            rate: rate.toFixed(1),
            amount: amount.toFixed(8)
        };

        var removed = this.trades.splice(this.getMaxTrades()-1);

        if(removed.length && this.removeTradeCallback){
             this.removeTradeCallback(removed.length);
        }

        this.trades.splice(0,0,trade);

        var change = 0;
        if(this.trades.length > 1){
            var previous_rate = this.trades[1].rate;
            change = (trade.rate - previous_rate)*100/previous_rate;
        }


        this.addTradeCallback && this.addTradeCallback(trade);
        this.lastPriceCallback && this.lastPriceCallback(trade.rate,change);
    };

    BLTCtrl.prototype.enableSocket = function (name) {
        this.options.exchanges[name] = true;
        this.socket_openers[name]();
        this.saveStorage();
    };

    BLTCtrl.prototype.disableSocket = function (name) {
        this.options.exchanges[name] = false;
        this.socket_closers[name]();
        this.saveStorage();
    };

    BLTCtrl.prototype.setMaxTrades = function (max_trades) {
        this.options.max_trades = parseInt(max_trades);

        this.saveStorage();
    };

    BLTCtrl.prototype.getMaxTrades = function () {
        return this.options.max_trades;
    };

    BLTCtrl.prototype.isExchangeEnabled = function (name) {
        return this.options.exchanges[name];
    };

    var blt_ctrl = new BLTCtrl();


    // jQuery custom plugins

    $.fn.extend({
        tradesTable: function () {
            var self = this;
            var tbody = this.find('tbody');


            blt_ctrl.removeTradeCallback = function (n) {
                tbody.find('tr').slice(-1*n).remove();
            };

            blt_ctrl.addTradeCallback = function (trade) {
                var html = '<tr><td>'+trade.exchange+'</td><td>'+trade.clock+'</td><td>'+trade.rate+'</td><td>'+trade.amount+'</td></tr>';

                tbody.prepend(html);

            };

            return self;
        },
        lastPrice: function () {
            var self = this;

            var price_elem = self.find('.price'),
                change_elem = self.find('.change');

            blt_ctrl.lastPriceCallback = function (rate,percentage) {

                var sign = percentage > 0 ? 'trending_up' :
                    percentage == 0 ? 'trending_flat' : 'trending_down';

                var abs_per = Math.abs(percentage).toFixed(3);

                price_elem.html('<i class="material-icons small">attach_money</i>'+rate);

                change_elem.html('<i class="material-icons small">'+sign+'</i>'+abs_per+'%');
            };

            return self;
        },
        exchangeCheckbox: function (exchange) {
            var self = this;
            var enabled = blt_ctrl.isExchangeEnabled(exchange);

            self.prop('checked',enabled);

            if(enabled){
                blt_ctrl.enableSocket(exchange);
            }

            self.change(function() {
                var checked = self.prop('checked');

                if(checked){
                    blt_ctrl.enableSocket(exchange);
                }
                else {
                    blt_ctrl.disableSocket(exchange);
                }
            });

            return self;
        },
        maxTradeRadios: function () {
            var self = this;

            self.each(function (i, radio) {
                if(this.value == blt_ctrl.getMaxTrades()){
                    this.checked = true;
                }
            });

            self.change(function () {
                blt_ctrl.setMaxTrades(this.value);
            });

            return self;
        }
    });





    // DOM Load

    $(function () {

        // Modal Initialization
        $('.modal').modal();

        // Side Nav Links Initialization
        $('.button-collapse').sideNav();

        // Trade Table Section Initialization
        $('#trades-table').tradesTable();

        // Last Price Section Initialization
        $('#last-price').lastPrice();

        // Enable/Disable Exchange Initialization
        $('#enable-gdax').exchangeCheckbox('gdax');
        $('#enable-bitfinex').exchangeCheckbox('bitfinex');
        $('#enable-bitstamp').exchangeCheckbox('bitstamp');


        // Max Trades Radio Initialization
        $('input[type=radio][name=max-trades]').maxTradeRadios();

    });




})(jQuery,Pusher);