<?php

/*
 *
 * Bitcoin Live Trading
 * version 1.0
 *
 * 2017 RunCoders (http://runcoders.com/)
 *
 *
 */

// Constants
define('BLT','1.0');
define('BLT_ROOT', dirname(__FILE__).'/');

// GZip Enable
ob_start("ob_gzhandler");


// Themes Primary Colors
$theme_colors = array(
    'red' => '#ef5350',
    'purple' => '#ab47bc',
    'deep-purple' => '#7e57c2',
    'indigo' => '#5c6bc0',
    'blue' => '#42a5f5',
    'light-blue' => '#29b6f6',
    'cyan' => '#26c6da',
    'teal' => '#26a69a',
    'green' => '#66bb6a',
    'orange' => '#ffa726',
    'deep-orange' => '#ff7043',
    'brown' => '#8d6e63',
    'blue-grey' => '#78909c'
);

?>

<?php

// SEO Options

$name = 'Your Page Name';
$title = 'Your Page Title';
$description = 'This is your search engine description';
$keywords = 'put, here, your, keywords';
// should use full URL
$seo_image = 'http://your-full-url.com/images/seo.png';


// Branding Options
$favicon_image = 'images/favicon.png';
$logo_image = 'images/logo.png';


/*
 * Theme Color
 *
 * Available:
 * red
 * purple
 * deep-purple
 * indigo
 * blue
 * light-blue
 * teal
 * green
 * orange
 * deep-orange
 * brown
 * blue-grey
 */


$theme = 'orange';


// Donation Addresses
$donation = array(
    'Bitcoin' => 'your_bitcoin_address',
    'Ethereum' => 'your_ethereum_address'
);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>"/>
    <meta name="keywords" content="<?php echo $keywords; ?>"/>

    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?php echo $description; ?>"/>
    <meta property="og:site_name" content="<?php echo $name; ?>"/>
    <meta property="og:image" content="<?php echo $seo_image; ?>" />

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="<?php echo $description; ?>"/>
    <meta name="twitter:title" content="<?php echo $title; ?>"/>
    <meta name="twitter:image" content="<?php echo $seo_image; ?>"/>

    <link rel="icon" type="image/png" href="<?php echo $favicon_image; ?>">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.0/css/materialize.min.css">
    <style>

        <?php $tc = $theme_colors[$theme]; ?>

        .chips .chip {
            background-color: <?php echo $tc; ?> !important;
            color: #fff !important;
        }


        input:not([type]):focus:not([readonly]),
        input[type=text]:not(.browser-default):focus:not([readonly]),
        input[type=password]:not(.browser-default):focus:not([readonly]),
        input[type=email]:not(.browser-default):focus:not([readonly]),
        input[type=url]:not(.browser-default):focus:not([readonly]),
        input[type=time]:not(.browser-default):focus:not([readonly]),
        input[type=date]:not(.browser-default):focus:not([readonly]),
        input[type=datetime]:not(.browser-default):focus:not([readonly]),
        input[type=datetime-local]:not(.browser-default):focus:not([readonly]),
        input[type=tel]:not(.browser-default):focus:not([readonly]),
        input[type=number]:not(.browser-default):focus:not([readonly]),
        input[type=search]:not(.browser-default):focus:not([readonly]),
        textarea.materialize-textarea:focus:not([readonly]),
        .chips.focus{
            border-bottom: 1px solid <?php echo $tc; ?> ;
            -webkit-box-shadow: 0 1px 0 0 <?php echo $tc; ?> ;
            box-shadow: 0 1px 0 0 <?php echo $tc; ?> ;
        }

        input:not([type]):focus:not([readonly])+label,
        input[type=text]:not(.browser-default):focus:not([readonly])+label,
        input[type=password]:not(.browser-default):focus:not([readonly])+label,
        input[type=email]:not(.browser-default):focus:not([readonly])+label,
        input[type=url]:not(.browser-default):focus:not([readonly])+label,
        input[type=time]:not(.browser-default):focus:not([readonly])+label,
        input[type=date]:not(.browser-default):focus:not([readonly])+label,
        input[type=datetime]:not(.browser-default):focus:not([readonly])+label,
        input[type=datetime-local]:not(.browser-default):focus:not([readonly])+label,
        input[type=tel]:not(.browser-default):focus:not([readonly])+label,
        input[type=number]:not(.browser-default):focus:not([readonly])+label,
        input[type=search]:not(.browser-default):focus:not([readonly])+label,
        textarea.materialize-textarea:focus:not([readonly])+label {
            color: <?php echo $tc; ?>;
        }

        .dropdown-content li>span {
            color: <?php echo $tc; ?>;
        }


        [type="checkbox"]:checked+label:before {
            border-right: 2px solid <?php echo $tc; ?>;
            border-bottom: 2px solid <?php echo $tc; ?>;
        }

        [type="checkbox"].filled-in:checked+label:after {
            border: 2px solid <?php echo $tc; ?>;
            background-color: <?php echo $tc; ?>;
        }

        [type="radio"]:checked+label:after, [type="radio"].with-gap:checked+label:after {
            background-color: <?php echo $tc; ?>;
        }

        [type="radio"]:checked+label:after, [type="radio"].with-gap:checked+label:before, [type="radio"].with-gap:checked+label:after {
            border: 2px solid <?php echo $tc; ?>;
        }

    </style>
    <link rel="stylesheet" href="css/blt.css">
</head>
<body class="<?php echo $theme; ?> lighten-5">

<nav class="<?php echo $theme; ?>">
    <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo">
            <img src="<?php echo $logo_image; ?>">
        </a>
        <ul id="top-nav" class="right hide-on-med-and-down">
            <li><a href="#">Top Link 1</a></li>
            <li><a href="#">Top Link 2</a></li>
            <li><a href="#">Top Link 3</a></li>
        </ul>

        <ul id="side-nav" class="side-nav">
            <li><a href="#">Side Link 1</a></li>
            <li><a href="#">Side Link 2</a></li>
            <li><a href="#">Side Link 3</a></li>
        </ul>

        <a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>




<div class="section" id="custom-1">
    <div class="container">
        <div class="row center">

        </div>
    </div>
</div>





<div class="section">
    <div class="container">
        <div id="live-stats" class="row card-panel <?php echo $theme; ?> darken-1 white-text">
            <div class="col s12 m6 l4">
                <img class="responsive-img" src="images/bitcoin.svg">
            </div>
            <div id="last-price" class="col s12 m6 l8 right-align">
                <h3 class="price"></h3>
                <h4 class="change"></h4>
            </div>
        </div>
        <div id="live-options" class="row card-panel">
            <div class="row">
                <div class="col s12 m6">
                    <p>
                        <label>Exchanges:</label>
                    </p>
                    <span>
                        <input type="checkbox" class="filled-in" id="enable-gdax" />
                        <label for="enable-gdax">GDAX</label>
                    </span>
                    <span>
                        <input type="checkbox" class="filled-in" id="enable-bitfinex" />
                        <label for="enable-bitfinex">Bitfinex</label>
                    </span>
                    <span>
                        <input type="checkbox" class="filled-in" id="enable-bitstamp" />
                        <label for="enable-bitstamp">Bitstamp</label>
                    </span>
                </div>

                <div class="col s12 m6">
                    <p>
                        <label>Max Trades:</label>
                    </p>
                    <span>
                        <input name="max-trades" type="radio" id="max-trades-25" value="25" />
                        <label for="max-trades-25">25</label>
                    </span>
                    <span>
                        <input name="max-trades" type="radio" id="max-trades-50" value="50" />
                        <label for="max-trades-50">50</label>
                    </span>
                    <span>
                        <input name="max-trades" type="radio" id="max-trades-100" value="100"  />
                        <label for="max-trades-100">100</label>
                    </span>
                </div>
            </div>
        </div>
        <div id="live-trades" class="row card-panel">
            <div class="row">
                <div class="col s12">
                    <h5 class="header">
                        Live Trades
                    </h5>
                </div>
                <div class="col s12">
                    <table id="trades-table" class="highlight bordered">
                        <thead>
                        <tr>
                            <th>Exchange</th>
                            <th>Time</th>
                            <th>Rate (USD)</th>
                            <th>Amount (BTC)</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="row">
                <div class="col s12" id="converter-outputs">
                    <div class="row" id="output-cards"></div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="section" id="custom-2">
    <div class="container">
        <div class="row center">

        </div>
    </div>
</div>




<footer id="footer" class="page-footer <?php echo $theme; ?>">
    <div class="container">
        <div class="row ">
            <div class="col l6 s12">
                <h5 class="white-text">Your Name Here</h5>
                <p class="grey-text text-lighten-4">Describe your page to your users in this field.</p>
                <div>
                    <a class="waves-effect waves-light <?php echo $theme; ?> lighten-1 btn modal-trigger" href="#donate-modal">Donate</a>
                </div>

            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Footer #1</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Footer #2</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container valign-wrapper <?php echo $theme; ?>-text text-lighten-3">
            <i class="small material-icons">copyright</i>
            &nbsp;<span class="foote">2017</span>
            &nbsp;<a class="<?php echo $theme; ?>-text text-lighten-3" href="/">RunCoders</a>
        </div>
    </div>
</footer>


<div id="donate-modal" class="modal">
    <div class="modal-content">
        <h4>Donation Title</h4>
        <p>Write here your donation message.</p>

        <ul id="donation-addresses" class="collection">

            <?php foreach ($donation as $name => $addr) : ?>
                <li class="collection-item avatar" data-addr="<?php echo $addr; ?>">
                    <div>
                        <i class="material-icons circle <?php echo $theme; ?>">money_off</i>
                        <div class="input-field address">
                            <input type="text" id="addr-<?php echo $addr; ?>" readonly value="<?php echo $addr; ?>">
                            <label for="addr-<?php echo $addr; ?>"><?php echo $name; ?></label>
                        </div>
                    </div>
                </li>
            <?php endforeach;?>

        </ul>
    </div>
    <div class="modal-footer">
        <button class="modal-action modal-close waves-effect waves-<?php echo $theme; ?> btn-flat">Thank You</button>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/4.1.0/pusher.min.js"></script>
<script src="js/blt.min.js"></script>
</body>
</html>











