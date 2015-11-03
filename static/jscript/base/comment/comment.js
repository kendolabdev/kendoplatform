(function ($) {
    var _debug = true,
        _dataKey = 'commentComposer',
        statusBox = 'textarea.mentions-input',
        postUrl = 'ajax/comment/comment/add',
        CommentComposer,
        defaults = {};

    CommentComposer = function (element, settings) {
        var _form = $(element),
            _target = _form.data('target'),
            _settings = $.extend({}, defaults, settings);


        function onSuccess(response) {

            if (_debug) {
                console.log('clean data of status form');
                console.log('feed result', response);
                // fire event to collapse new state
            }

            if ($(_target).length) {
                $(_target).trigger('loadnew');
            }

            if (typeof _form != 'undefined') {

                $(response.html).insertBefore(_form.closest('.fs-cmf-ow'));

                _form.trigger('clean');
                _form.find('textarea').val('');
                // reset mention miput
                $('textarea.mentions-input', _form).mentionsInput('reset');
            }
        }

        function onComplete() {
            onLoadingComplete();
        }

        function onError() {
            alert("Sorry, your request could not be completed");
        }


        function doFormSubmit() {
            var sendData = $.extend({}, _form.serializeJSON(), {fromComment: 1});

            $(statusBox, _form).mentionsInput('val', function (text) {
                sendData.commentTxt = text;
            });

            onLoadingStart();

            K.ajax(postUrl, sendData)
                .always(onComplete)
                .done(onSuccess)
                .fail(onError);
        }

        function onLoadingStart() {
            $('.fc-header-ow .ajax-indicator', _form).addClass('loading');
        }

        function onLoadingComplete() {
            $('.fc-header-ow .ajax-indicator', _form).removeClass('loading');
        }

        $(statusBox, _form).mentionsInput({});

        _form.on('onLoading:start', function () {
            onLoadingStart();
        }).on('onLoading:done', function () {
            onLoadingComplete();
        }).on('clean', function () {
            $('.fc-att-row', _form).addClass('hidden');
        }).on('submit', function (evt) {
            evt.preventDefault();
            doFormSubmit();
        }).on('clearBootInit', function () {
            _form.data(_dataKey, false);
        });

        if (_form.data('link')) {
            _form.linkComposer();
        }
    }


    /**
     * Constructor of feed stream
     * @returns {*}
     */
    $.fn.commentComposer = function () {
        return this.each(function () {
            return $.data(this, _dataKey) || $.data(this, _dataKey, new CommentComposer(this, $.data(this, 'composer')));
        });
    }

    /**
     * Focus status box action
     */
    $(document).on('focus', '[data-toggle="comment-box"]', function (evt) {
        $(evt.currentTarget).closest('form').commentComposer({});
    });
})(jQuery);

(function ($) {

    $(document).on('click', '[data-toggle="comment-remove"]', function () {
        var ele = $(this),
            data = ele.data('object'),
            eid = ele.data('eid'),
            stage = $(eid).closest('.cmt-item');

        if(!K.authRequired()) return;

        stage.animate({opacity:0},500, function(){stage.addClass('hidden')})

        ele.prop('disabled');

        K.ajax('ajax/comment/comment/remove', data)
            .always(function () {
                ele.prop('disabled', false)
            })
            .done(function (response) {
                if(response.code != 200){
                    stage.removeClass('hidden').animate({opacity:1});
                }
            });
    });

    $(document).on('click', '[data-toggle="comment-edit"]', function () {
        var ele = $(this),
            data = ele.data(),
            eid = ele.data('eid');

        if(!K.authRequired()) return;

        K.ajax('ajax/comment/comment/inline-edit', data)
            .done(function () {
            });
    });

    /**
     * Handle comment button
     */
    $(document).on('click', '[data-toggle="btn-comment"]', function (evt) {
        var ele = $(evt.target),
            stage = ele.closest('.feed-item'),
            form = stage.find('.fs-cmf-ow');

        if(!K.authRequired()) return;

        form.removeClass('hidden');
        form.find('.fc-mention-input').focus();
    });

    /**
     * view more comments
     */
    $(document).on('click', '[data-toggle="comment-more"]', function (evt) {
        var ele = $(this),
            loading = ele.data('loading'),
            obj = ele.data('object'),
            stage = ele.closest('.card-footer'),
            cmts = stage.find('.cmt-item'),
            parent = ele.closest('div'),
            ids = [];


        if (loading) return;

        cmts.each(function (i, e) {
            var id = $(e).data('id');
            if (!/undefined/.test(id))ids.push(id)
        });

        var sendData = $.extend({}, obj, {excludes: ids});
        // how to exclude exists data

        /**
         * @param response
         */
        function onSuccess(response) {

            if (response.html == "") {
                ele.closest('div').addClass('hidden');
            } else {
                $(response.html).insertBefore($('.cmt-item:first', stage));
                var total = response.commentCount,
                    counter = $('.cmt-item', stage).length,
                    cmds = $(response.cmds);

                $('.counter', cmds).text(counter);

                if (total == counter) {
                    ele.closest('div').addClass('hidden');
                }

                parent.html(cmds);
            }
        }

        // always
        function onComplete() {
            ele.data('loading', false);
        }

        ele.data('loading', true);

        K.ajax('ajax/comment/comment/view-more', sendData)
            .done(onSuccess)
            .complete(onComplete)
            .error();

    });
})(jQuery);