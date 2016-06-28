jQuery(function ($) {

    var nav = $('.page-template-template-home-three #navigation');
    var scrolled = false;

    $(window).scroll(function () {

        if (120 < $(window).scrollTop() && !scrolled) {
            nav.addClass('menu-sticky animated fadeInDown').animate({'margin-top' : '0px'});

            scrolled = true;
        }

        if (120 > $(window).scrollTop() && scrolled) {
            nav.removeClass('menu-sticky animated fadeInDown').css('margin-top', '0px');

            scrolled = false;
        }
    });

});