/**
 * Activity Feed Javascript component
 * @author Nam Nguyen
 * @project Picaso
 * @version 1.0.1
 */

define(['jquery'],function(){

    /**
     * Feed item function
     */
    (function ($) {

        var _debug = false;



        $(document).on('click', '[data-toggle="btn-block"]', function (evt) {
            var btn = $(this),
                data = $.extend({}, btn.data('object'), {ctx: btn.hasClass('btn') ? 'btn' : 'menu'});

            btn.prop('disabled', false);

            K.ajax('ajax/core/block/toggle', data)
                .done(function (res) {
                    btn.closest('.btn-blocking').replaceWith(res.html);
                }).always(function () {
                btn.prop('disabled', false);
            });
        });

        $(document).on('click', '[data-toggle="btn-remove-blocking"]', function (evt) {
            var ele = $(evt.currentTarget),
                data = ele.data('object');

            K.ajax('ajax/core/block/remove', data)
                .done(function (response) {
                    _debug && console.log(response);
                });
        });

    })(window.jQuery);


    /**
     * Composer function
     */
    (function ($) {

        var _debug = true;

        /**
         * tag location
         */
        $(document).on('click', '[data-toggle="fc-btn-location"]', function (evt) {
            var $e = $(evt.currentTarget);
            var $f = $e.closest('form');

            if (true) {
                $f.find('.fc-att-location').removeClass('hidden');
                $f.find('.fc-att-people').addClass('hidden');
                $f.find('.fc-att-location-input').focus();
            }
        });

        /**
         * tag peoples
         */
        $(document).on('click', '[data-toggle="fc-btn-people"]', function (evt) {
            var $e = $(evt.currentTarget);
            var $f = $e.closest('form');

            if (true) {
                $f.find('.fc-att-people').removeClass('hidden');
                $f.find('.fc-att-location').addClass('hidden');
                $f.find('.fc-att-people-input').focus();
            }
        });

        $(document).on('click', '[data-toggle="fc-ph-people"]', function (evt) {
            var $e = $(evt.currentTarget);
            $e.find('.fc-att-people-input').focus();
        });


        /**
         * attach photo
         */
        $(document).on('click', '[data-toggle="fc-btn-photo"]', function () {
            var ele = $(this),
                form = ele.closest('form'),
                target = ele.data('target');

            _debug && console.log(target, $(target, form), this);

            if (true) {
                form.find('.fc-att-row').addClass('hidden');
                form.find('.fc-att-photo').removeClass('hidden');
            }

            // process photo build
            $(target, form).trigger('click');
        });

        $(document).on('focus', '[data-toggle="placeinput"]', function (e) {
            var $e = $(e.currentTarget);

            if (!$e.data('placeinput')) {
                $e.data('placeinput', new PlaceInput($e));
            }
        });


        $(document).on('focus', '[data-toggle="tag-people"]', function (evt) {
            var ele = $(evt.currentTarget);

            if (ele.data('tagsinput', false)) {
                return false;
            }
            ele.data('tagsinput', new TagsInput(ele, {}));
        });


        $(document).on('click', '[data-toggle="btn-feed-loadmore"]', function (evt) {
            $(evt.currentTarget)
                .closest('.feed-stream')
                .trigger('loadmore');
        });

        $(document).on('click', '[data-toggle="btn-remove-feed"]', function (e) {
            var ele = $(e.currentTarget),
                outer = ele.closest('.fs-ow'),
                data = ele.data('object')
                ;

            outer.hide();

            K.ajax('ajax/feed/feed/remove', data)
                .done(function (response) {

                });
        });

        $(document).on('click', '[data-toggle="feed-remove"]', function (e) {
            var ele = $(e.currentTarget),
                data = ele.data('object'),
                outer = $(data.eid).closest('.card-feed');

            _debug && console.log(outer);

            outer.animate({opacity: 0}, 500, function () {
                outer.hide()
            });

            K.ajax('ajax/feed/feed/remove', data)
                .done(function (response) {

                });
        });

        $(document).on('click', '[data-toggle="feed-open-privacy"]', function (e) {
            var ele = $(e.currentTarget),
                data = ele.data('object'),
                outer = $(data.eid).closest('.card-feed').find('.privacy-label:first');

            if (outer.length)
                outer.trigger('click');


        });




        $(document).on('click', '[data-toggle="feed-hide"]', function (evt) {
            var ele = $(evt.currentTarget),
                data = ele.data('object'),
                outer = $(data.eid).closest('.card-feed');

            outer.animate({opacity: 0}, 500, function () {
                outer.hide()
            });

            if (ele.prop('disabled')) return;

            ele.prop('disabled', true);

            K.ajax('ajax/feed/feed/toggle-hidden', data)
                .always(function () {
                    ele.prop('disabled', false)
                }).done(function (response) {
                _debug && console.log(response);
                ele.html(response.html);
            });
        });

        $(document).on('click', '[data-toggle="feed-hide-timeline"]', function (evt) {
            var ele = $(evt.currentTarget),
                data = ele.data('object'),
                outer = $(data.eid).closest('.card-feed');

            outer.animate({opacity: 0}, 500, function () {
                outer.hide()
            });

            if (ele.prop('disabled')) return;

            ele.prop('disabled', true);

            K.ajax('ajax/feed/feed/toggle-hide-timeline', data)
                .always(function () {
                    ele.prop('disabled', false)
                }).done(function (response) {
                _debug && console.log(response);
                ele.html(response.html);
            });
        });

        $(document).on('click', '[data-toggle="feed-edit-submit"]', function (evt) {
            var ele = $(this),
                form = ele.closest('form'),
                data = form.serializeJSON(),
                outer = form.closest('.fs-story-ow');

            if (form.prop('disabled'))
                return;

            $('.mentions-input', form).mentionsInput('val', function (text) {
                data.statusTxt = text;
            });

            _debug && console.log(data);

            form.prop('disabled', true);

            K.ajax('ajax/feed/feed/save-inline-edit', data)
                .always(function () {
                    form.prop('disabled', false);
                }).done(function (response) {
                _debug && console.log(response);
                outer.html(response.html);
            });
        });

        $(document).on('click', '[data-toggle="feed-edit-cancel"]', function (evt) {
            var ele = $(this),
                form = ele.closest('form'),
                data = form.serializeJSON(),
                outer = form.closest('.fs-story-ow');

            _debug && console.log(data);

            if (form.prop('disabled'))
                return;

            form.prop('disabled', true);

            K.ajax('ajax/feed/feed/cancel-inline-edit', data)
                .always(function () {
                    form.prop('disabled', false);
                }).done(function (response) {
                _debug && console.log(response);
                outer.html(response.html);
            });
        });

        $(document).on('click', '[data-toggle="feed-subscribe"]', function (evt) {
            var ele = $(evt.currentTarget),
                data = ele.data('object');

            if (ele.prop('disabled')) return;

            ele.prop('disabled', true);

            evt.preventDefault();

            K.ajax('ajax/feed/feed/toggle-subscribe', data)
                .always(function () {
                    ele.prop('disabled', false)
                }).done(function (response) {
                _debug && console.log(response);
                ele.html(response.html);
            });

        });


        $(document).on('click', '[data-toggle="feed-edit"]', function (evt) {
            var ele = $(evt.currentTarget),
                data = ele.data('object'),
                parent = '[data-feedid="' + data.id + '"]',
                stage = $(parent).find('.fs-story-ow');

            if (!stage.length)
                stage = $('<div class="fs-story-ow">').insertAfter($(parent).find('.fs-headline-ow'));

            K.ajax('ajax/feed/feed/edit-inline', data)
                .done(function (response) {
                    stage.html(response.html)
                        .removeClass('hidden')
                        .find('textarea').mentionsInput({});
                });
        });
    })(jQuery, _);
});