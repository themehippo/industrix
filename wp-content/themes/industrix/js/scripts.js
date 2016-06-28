/**=========================================================
 * Name: scripts.js
 * Author: Theme Hippo
 * Author URI: https://themehippo.com/
 * Version: 1.0.0
 =========================================================*/


jQuery(function ($) {


    'use strict';


    /*------------------------------------*\
     -------------------------------------
     INDEX
     -------------------------------------

     # JS Wrapper
     # Browser to detect IE
     # Project Carousel
     # Scroll up
     # Google Map
     # Dropdown menu
     # shuffle
     # Off Canvas
     # Pretty Photo
     # Magazine Slider
     # News Ticker
     # Tab responsive


     \*------------------------------------*/


    // =============================================
    //  JS Wrapper
    // =============================================

    (function () {

    }());

    // =============================================
    //  Project Carousel
    // =============================================


    (function () {

        // Project carousel
        $(".css-product").owlCarousel({
            // autoPlay: 3000, //Set AutoPlay to 3 seconds
            pagination        : false,
            items             : 3,
            itemsDesktop      : [1199, 3],
            itemsDesktopSmall : [979, 2],
            itemsTablet       : [768, 2],
            itemsMobile       : [479, 1]
        });

        $(".css-product-navigation .next").click(function () {
            $(".css-product").trigger('owl.next');
        });

        $(".css-product-navigation .prev").click(function () {
            $(".css-product").trigger('owl.prev');
        });


        // Partner carousel

        var clientCarousal = $(".partners-caruosel");
        var clientCarousalItems = parseInt(clientCarousal.attr('data-largescreen'));
        var clientCarousalItemsDesktop = parseInt(clientCarousal.attr('data-desktop'));
        var clientCarousalItemsDesktopSmall = parseInt(clientCarousal.attr('data-desktopsmall'));
        var clientCarousalItemsTablet = parseInt(clientCarousal.attr('data-tablet'));

        clientCarousal.owlCarousel({
            autoPlay          : 3000, //Set AutoPlay to 3 seconds
            pagination        : false,
            items             : clientCarousalItems,
            itemsDesktop      : [1199, clientCarousalItemsDesktop],
            itemsDesktopSmall : [979, clientCarousalItemsDesktopSmall],
            itemsTablet       : [768, clientCarousalItemsTablet]
        });

        // Custom Navigation Events
        $(".partners-caruosel-navigation .next").click(function () {
            $(".partners-caruosel").trigger('owl.next');
        });

        $(".partners-caruosel-navigation .prev").click(function () {
            $(".partners-caruosel").trigger('owl.prev');
        });


        // Testimonial
        $(".client-testimonial").owlCarousel({
            // autoPlay: 5000, //Set AutoPlay to 3 seconds
            pagination        : false,
            items             : 1,
            itemsDesktop      : [1199, 1],
            itemsDesktopSmall : [979, 1],
            itemsTablet       : [768, 1],
            itemsMobile       : [479, 1]
        });

        // Custom Navigation Events
        $(".client-testimonial-navigation .next").click(function () {
            $(".client-testimonial").trigger('owl.next');
        });

        $(".client-testimonial-navigation .prev").click(function () {
            $(".client-testimonial").trigger('owl.prev');
        });


        // Latest news
        $(".latest-news").owlCarousel({
            // autoPlay: 3000, //Set AutoPlay to 3 seconds
            pagination        : false,
            items             : 2,
            itemsDesktop      : [1199, 2],
            itemsDesktopSmall : [979, 2],
            itemsTablet       : [768, 1],
            itemsMobile       : [479, 1]
        });

        $(".latest-news-navigation .next").click(function () {
            $(".latest-news").trigger('owl.next');
        });

        $(".latest-news-navigation .prev").click(function () {
            $(".latest-news").trigger('owl.prev');
        });

    }());


    // =============================================
    //  Scroll up
    // =============================================
    (function () {

        if (industrixJSObject.scroll_to_top) {
            $.scrollUp({
                scrollText        : '',
                topDistance       : '300',
                animation         : 'fade',
                animationInSpeed  : 200,
                animationOutSpeed : 200
            });
        }
    }());


    // -------------------------------------------------------------
    // Dropdown menu
    // -------------------------------------------------------------

    (function () {

        function getIEVersion() {
            var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
            return match ? parseInt(match[1]) : false;
        }

        if (getIEVersion()) {
            $('html').addClass('ie ie' + getIEVersion());
        }

        if ($('html').hasClass('ie9') || $('html').hasClass('ie10')) {
            $('.submenu-wrapper').each(function () {
                $(this).addClass('no-pointer-events');
            });
        }


        var timer;

        $('li.dropdown').on('mouseenter', function (event) {


            event.stopImmediatePropagation();
            event.stopPropagation();

            $(this).removeClass('open menu-animating').addClass('menu-animating');
            var that = this;


            if (timer) {
                clearTimeout(timer);
                timer = null;
            }

            timer = setTimeout(function () {

                $(that).removeClass('menu-animating');
                $(that).addClass('open');

            }, 300);   // 300ms as animation end time
        });

        // on mouse leave

        $('li.dropdown').on('mouseleave', function (event) {

            var that = this;
            $(this).removeClass('open menu-animating').addClass('menu-animating');

            if (timer) {
                clearTimeout(timer);
                timer = null;
            }

            timer = setTimeout(function () {
                $(that).removeClass('menu-animating');
                $(that).removeClass('open');
            }, 300);  // 300ms as animation end time
        });
    }());


    // =============================================
    //  shuffle
    // =============================================


    (function () {
        /* initialize shuffle plugin */
        var $grid = $('#grid');

        $grid.shuffle({
            itemSelector : '.item' // the selector for the items in the grid
        });

        /* reshuffle when user clicks a filter item */
        $('#filter a').click(function (e) {
            e.preventDefault();

            // set active class
            $('#filter a').removeClass('active');
            $(this).addClass('active');

            // get group name from clicked item
            var groupName = $(this).attr('data-group');

            // reshuffle grid
            $grid.shuffle('shuffle', groupName);
        });

    }());


    // =============================================
    //  Off Canvas
    // =============================================

    (function () {

        // click button
        $('.navbar-toggle').HippoOffCanvasMenu({

            documentWrapper : '#wrapper',
            contentWrapper  : '.contents',
            position        : industrixJSObject.offcanvas_menu_position,    // class name
            // opener         : 'st-menu-open',         // class name
            effect          : industrixJSObject.offcanvas_menu_effect,  // class name
            closeButton     : '.close-sidebar',
            menuWrapper     : '#offcanvasmenu',                // class name
            documentPusher  : '.pusher'
        });
    }());


    // =============================================
    //  Pretty Photo
    // =============================================

    (function () {

        $("a[href$='.png'], a[href$='.jpg'], a[href$='.jpeg']").prettyPhoto({
            social_tools : false
        });
    }());


    // =============================================
    // css class
    // =============================================

    $(".magazine-slider .carousel-inner > .item:first-child").addClass("active")
    $(".testimonial-panel .panel:first-child .panel-collapse").addClass("in");
    $(".rev_slider_wrapper").addClass("box-shadow");


    // =============================================
    //  News Ticker
    // =============================================

    (function () {
        $('#news-ticker').ticker({
            titleText : industrixJSObject.news_ticker_title
        });
    }());

    // -------------------------------------------------------------
    // Icon tab
    // -------------------------------------------------------------

    (function () {
        [].slice.call(document.querySelectorAll('div.tabs')).forEach(function (el) {
            new CBPFWTabs(el);
        });
    })();
});