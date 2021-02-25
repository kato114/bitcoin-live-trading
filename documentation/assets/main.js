(function () {


    var SECTIONS = [
        'intro', 'upload', 'configuration', 'contributes', 'change-log', 'support'
    ];

    function showSection(section) {

        var side_menu = $('#side-menu');

        SECTIONS.forEach(function (sec) {
            if(sec != section){
                $('#'+sec).hide();
            }
        });

        $('#'+section).show();
        side_menu.children('.item[data-section!="'+section+'"]').removeClass('active');
        side_menu.children('.item[data-section="'+section+'"]').addClass('active');
    }

    $(function () {

        $('[data-section]').click(function () {
            var section = $(this).data('section');
            showSection(section);
            $("html, body").animate({ scrollTop: 0 });
        });

        showSection('intro');
    });


})();