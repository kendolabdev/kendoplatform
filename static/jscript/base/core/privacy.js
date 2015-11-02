/*privacy*/

(function ($) {
    var _debug = true;

    /**
     * select privacy options for parent
     */
    $(document).on('click', '[data-toggle="btn-option-privacy"]', function (evt) {
        var option = $(evt.currentTarget),
            btn = $(option.data('eid')),
            data = option.data('privacy'),
            obj = btn.data('object'),
            sendData = $.extend({}, obj, {privacy: {type: data.type, value: data.value}})
            ;

        if (!btn.length) return;

        if (_debug) {
            console.log('update privacy value for button');
            console.log(data);
        }

        if (btn.length) {
            btn.find('span.text').text(data.label);
            btn.find('input.privacy-value').val(data.value);
            btn.find('input.privacy-type').val(data.type);
        }

        K.ajax('ajax/relation/privacy/change-default', sendData)
            .done(function (json) {
                console.log(json);
            });
    });

    /**
     * select privacy options for parent
     */
    $(document).on('click', '[data-toggle="btn-edit-option-privacy"]', function (evt) {
        var option = $(evt.currentTarget),
            btn = $(option.data('eid')),
            data = option.data('privacy'),
            obj = btn.data('object'),
            sendData = $.extend({}, obj, {privacy: {type: data.type, value: data.value, eid: option.data('eid')}})
            ;

        if (!btn.length) return;

        if (_debug) {
            console.log('update privacy value for button');
            console.log(data);
        }

        btn.prop('disabled', true);

        /**
         * update privacy value
         */
        K.ajax('ajax/relation/privacy/update-privacy', sendData)
            .always(function(){
                btn.prop('disabled',false);
            }).done(function (response) {
                btn.replaceWith(response.html);
            });
    });

})(window.jQuery);