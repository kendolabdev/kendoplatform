/**
 * Retry or generate eid
 */
(function ($) {
    $.fn.eid = function (prefix) {
        if (/undefined/i.test(typeof prefix))prefix = 'e';

        if (!$(this).prop('id')) {
            $(this).prop('id', K.newId(prefix, 8));
        }
        return $(this).prop('id');
    }
})(jQuery);

/**
 * Define scrollToTop plugins
 */
(function ($) {
    var _debug = true,
        _key = 'scrollToTop',
        _ScrollToTop = function (ele) {
            var element = ele,
                distance = 300,
                speed  = 200
                ;

            _debug && console.log('_ScrollToTop.construct');

            element.on('click', function () {
                $('html, body').animate({scrollTop: 0},  speed);
            });

            $(window).on('scroll', function () {
                if ($(this).scrollTop() > distance) {
                    element.addClass('in')
                } else {
                    element.removeClass('in');
                }
            });
        };

    $.fn.scrollToTop = function () {
        var ele = $(this),
            instance;

        instance = ele.data(_key);

        if (!instance) {
            ele.data(_key, instance = new _ScrollToTop(ele));
        }
        return instance;
    }
})(jQuery);