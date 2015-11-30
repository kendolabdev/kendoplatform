/**
 * data ride for auto load
 */
(function ($) {
    var _debug = false,
        _dirty = '#dirty',
        _main = '#main',
        _href = '',
        _clearBootInit = false,
        _documentBooted = false,
        _interval = 1000;

    /**
     * Boot Init data
     */
    $.fn.bootInit = function () {
        $('[ride]', this).each(function () {
            var ele = $(this),
                method = ele.attr('ride');

            if (_debug) {
                console.log("boot element " + method, ele);
            }

            if (method && typeof ele[method] == 'function') {
                ele[method]({});
            }
        });
    }

    /**
     * clear boot init data
     */
    $.fn.clearBootInit = function () {
        _debug && console.log('Clear Boot Init');

        $('[ride]', this).each(function () {
            $(this).trigger('clearBootInit');
        });
    }

    window.BootInit = function () {
        _href = document.location.href;
        _clearBootInit = !$(_dirty).val();

        // changed data val
        $(_dirty).val(1);

        if (_clearBootInit) {
            _debug && console.log('clear all boot init');
            $(document).clearBootInit();
        }

        if (_clearBootInit || !_documentBooted) {
            _debug && console.log('boot init DOCUMENT');
            $(document).bootInit();

        } else {
            _debug && console.log('boot init MAIN');

            $(_main).bootInit();
        }
        _documentBooted = true;
    }

    window.setInterval(function () {
        if (_href != document.location.href) {
            BootInit();
        }
    }, _interval);

    // push footer to bottom
    $(document).ready(function () {
        var remain = window.innerHeight - $('#header').outerHeight() - $('#footer').outerHeight() + 22;
        if (remain > 0) {
            $('#main').css({minHeight: remain});
        }
    });
})(jQuery);