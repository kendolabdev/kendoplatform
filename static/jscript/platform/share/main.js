
/**
 * Activity Share Javascript Component
 *
 * @author Nam Nguyen
 * @project Picaso
 * @version 1.0.1
 */
define(['jquery'],function(){
    var debug = true,
        propKey = 'shareComposer',
        statusBox = 'textarea.mentions-input',
        postUrl = 'ajax/share/share/add',
        ShareComposer,
        defaults = {
        };

    ShareComposer = function (element, settings) {
        var _form = $(element),
            _target = _form.data('target'),
            _settings = $.extend({}, defaults, settings);


        function onSuccess(response) {

            if (debug) {
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
        });

        if(_form.data('link')){
            _form.linkComposer();
        }
    }


    /**
     * Constructor of feed stream
     * @returns {*}
     */
    $.fn.shareComposer = function () {
        return this.each(function () {
            return $.data(this, propKey) || $.data(this, propKey, new ShareComposer(this, $.data(this, 'composer')));
        });
    }

    /**
     * Focus status box action
     */
    $(document).on('focus', '[data-toggle="share-box"]', function (evt) {
        $(evt.currentTarget).closest('form').shareComposer({});
    });

    var prop = 'mentionsInput';

    $(document).on('focus', '[data-toggle="share-box"]', function (evt) {
        var ele = $(evt.currentTarget);
        if (!ele.data(prop)) {
            ele.mentionsInput({}).focus();
            //ele.closest('form').linkComposer();
        }
    });

    /**
     * Handle share on internal
     */
    $(document).on('click', '[data-toggle="btn-share"]', function () {
        var $e = $(this),
            data = $e.data('object');

        if(!K.authRequired()) return;

        K.modal('ajax/share/share/modal', data);
    });

    /**
     * share button submit
     */
    $(document).on('click', '[data-toggle="btn-share-sumbit"]', function (evt) {
        var ele = $(evt.currentTarget),
            form = ele.closest('form'),
            data = form.serializeJSON();

        $('textarea.mentions-input', form).mentionsInput('val', function (text) {
            data.contentTxt = text;
        });

        K.ajax('ajax/share/share/add', data)
            .done(function () {
                K.closeModal();
            });
    });

    /**
     * share on your own
     */
    $(document).on('click', '[data-toggle="btn-share-own"]', function (evt) {
        var $e = $(evt.currentTarget);
        var $f = $e.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text($e.data('label'));
        $f.find('.share-control-ow').addClass('hidden');
    });

    /**
     * share on friends timeline
     */
    $(document).on('click', '[data-toggle="btn-share-friend"]', function (evt) {
        var $e = $(evt.currentTarget);
        var $f = $e.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text($e.data('label'));
        $f.find('.share-control-ow').removeClass('hidden');
        $f.find('.share-control-input').trigger('cleanup').focus();

    });

    /**
     * share on groups timeline
     */
    $(document).on('click', '[data-toggle="btn-share-group"]', function (evt) {
        var $e = $(evt.currentTarget);
        var $f = $e.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text($e.data('label'));
        $f.find('.share-control-ow').removeClass('hidden');
        $f.find('.share-control-input').trigger('cleanup').focus();
    });

    /**
     * share on pages timeline
     */
    $(document).on('click', '[data-toggle="btn-share-page"]', function (evt) {
        var $e = $(evt.currentTarget);
        var $f = $e.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text($e.data('label'));
        $f.find('.share-control-ow').removeClass('hidden');
        $f.find('.share-control-input').trigger('cleanup').focus();
    });

    /**
     * share on pages timeline
     */
    $(document).on('click', '[data-toggle="btn-share-message"]', function (evt) {
        var $e = $(evt.currentTarget);
        var $f = $e.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text($e.data('label'));
        $f.find('.share-control-ow').removeClass('hidden');
        $f.find('.share-control-input').trigger('cleanup').focus();
    });
});