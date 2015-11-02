(function ($) {
    var defaultOptions, AutoComplete, debug;

    debug = true;

    defaultOptions = {
        minChars: 1,
        delay: 150,
        cache: 1,
        menuClass: '',
        renderItem: function (sc, item, search) {
            return $('<div/>', {
                class: 'autocomplete-suggestion'
            }).data('val', item.name)
                .data('search', search)
                .html(item.name)
                .appendTo(sc);
        },
        onSelect: function (e, term, item, input, sc) {
            // void
        },
        source: function (val, suggest) {
            $.getJSON('/younetco.com/picaso/ajax', {
                do: 'user.friends:suggest',
                q: val
            }, function (res) {
                suggest(res);
            });
        }
    };

    AutoComplete = function (element, options) {
        var that;

        options = $.extend({}, defaultOptions, options);

        that = $(element);
        that.cache = {};
        that.lastVal = '';

        that.attr('autocomplete', 'off');
        that.sc = $('<div>', {
            class: 'autocomplete-suggestions'
        }).appendTo('body');

        that.updateSC = function (resize, next) {
            that.sc.css({
                top: that.offset().top + that.outerHeight(),
                left: that.offset().left,
                width: that.outerWidth()
            });
        }

        function suggest(data) {
            var val = that.val();
            that.cache[val] = data;
            if (data.length && val.length >= options.minChars) {

                for (var i = 0; i < data.length; i++) {
                    options.renderItem(that.sc, data[i], val);
                }
                that.updateSC(0);
                that.sc.show();
            }
            else {
                that.sc.hide();
            }

            if (debug) {
                console.info("update suggestions");
            }
        }

        that.sc.on('mouseleave', '.autocomplete-suggestion', function () {
            $('.autocomplete-suggestion.selected', that.sc).removeClass('selected');
        });

        that.sc.on('mouseenter', '.autocomplete-suggestion', function () {
            $('.autocomplete-suggestion.selected', that.sc).removeClass('selected');
            $(this).addClass('selected');
        });

        that.sc.on('mousedown', '.autocomplete-suggestion', function (e) {
            var item = $(this), v = item.data('val');
            if (v || item.hasClass('autocomplete-suggestion')) { // else outside click
                that.val(v);
                options.onSelect(e, v, item, that, that.sc);
                that.focus();
                that.sc.hide();
            }
        });

        that.on('blur.autocomplete', function () {
            var over_sb;
            try {
                over_sb = $('.autocomplete-suggestions:hover', that.sc).length;
            } catch (e) {
                over_sb = 0;
            } // IE7 fix :hover
            if (!over_sb) {
                that.lastVal = that.val();
                that.sc.hide();
            } else {
                that.focus();
            }
        });

        if (!options.minChars) {
            that.on('focus.autocomplete', function () {
                that.lastVal = '\n';
                that.trigger('keyup.autocomplete');
            });
        }

        that.on('keydown.autocomplete', function (e) {
            // down (40), up (38)
            if ((e.which == 40 || e.which == 38) && that.sc.html()) {
                var next, sel = $('.autocomplete-suggestion.selected', that.sc);
                if (!sel.length) {
                    next = (e.which == 40) ? $('.autocomplete-suggestion', that.sc).first() : $('.autocomplete-suggestion', that.sc).last();
                    that.val(next.addClass('selected').data('val'));
                } else {
                    next = (e.which == 40) ? sel.next('.autocomplete-suggestion') : sel.prev('.autocomplete-suggestion');
                    if (next.length) {
                        sel.removeClass('selected');
                        that.val(next.addClass('selected').data('val'));
                    }
                    else {
                        sel.removeClass('selected');
                        that.val(that.lastVal);
                        next = 0;
                    }
                }
                that.updateSC(0, next);
                return false;
            }
            else if (e.which == 27) {
                /**
                 * escape key code
                 */
                that.val(that.lastVal).sc.hide();
            }
            else if (e.which == 13) {
                /**
                 * enter key code
                 */
                var sel = $('.autocomplete-suggestion.selected', that.sc);
                if (sel.length) {
                    options.onSelect(e, sel.data('val'), sel);
                    setTimeout(function () {
                        that.focus().sc.hide();
                    }, 10);
                }
            }
        });

        that.on('keyup.autocomplete', function (e) {
            if (!~$.inArray(e.which, [27, 38, 40, 37, 39])) {
                var val = that.val();
                if (val.length >= options.minChars) {
                    if (val != that.lastVal) {
                        that.lastVal = val;
                        clearTimeout(that.timer);
                        if (options.cache) {
                            if (val in that.cache) {
                                suggest(that.cache[val]);
                                return;
                            }
                            // no requests if previous suggestions were empty
                            for (var i = 1; i < val.length - options.minChars; i++) {
                                var part = val.slice(0, val.length - i);
                                if (part in that.cache && !that.cache[part].length) {
                                    suggest([]);
                                    return;
                                }
                            }
                        }
                        that.timer = setTimeout(function () {
                            options.source(val, suggest)
                        }, options.delay);
                    }
                } else {
                    that.lastVal = val;
                    that.sc.hide();
                }
            }
        });

        $(window).on('resize.autocomplete', that.updateSC);

        if (debug) {
            console.info('init tags input');
        }
    };

    window.AutoComplete = AutoComplete;


    $(document).on('focus', '[data-toggle="auto-complete"]', function (evt) {
        var $e = $(evt.target);
        if (!$e.data('tagsinput')) {
            $e.data('tagsinput', new AutoComplete($e));
        }
    })
})(window.jQuery);
