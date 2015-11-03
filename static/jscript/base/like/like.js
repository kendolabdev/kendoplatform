(function ($) {
    /**
     * Handle like button
     */
    $(document).on("click", '[data-toggle="btn-like"]', function (evt) {
        var ele = $(evt.currentTarget),
            data = ele.data('object'),
            stage = ele.closest('.card-feed');

        if(!K.authRequired()) return;

        function success(response) {

            ele.text(response.label);

            if (stage.length) {
                if (response.hasSample) {
                    stage.find('.fs-like-sample').html(response.sample).removeClass('hidden');
                } else {
                    stage.find('.fs-like-sample').addClass('hidden');
                }
            }
        }

        K.ajax('ajax/like/like/toggle', data)
            .done(success);
    });

    /**
     * Handle like button
     */
    $(document).on("click", '[data-toggle="like-comment-toggle"]', function () {
        var ele = $(this),
            data = ele.data('object'),
            stage = ele.closest('.fs-cm-asset');

        if(!K.authRequired()) return;

        function success(response) {
            ele.text(response.label);

            if (stage.length) {
                if (response.sample != "") {
                    stage.find('.cmt-like-samples-ow').removeClass('hidden');
                    stage.find('.cmt-like-samples').html(response.sample);
                } else {
                    stage.find('.cmt-like-samples-ow').addClass('hidden');
                    stage.find('.cmt-like-samples').html(response.sample);
                }

            }
        }

        K.ajax('ajax/like/like/toggle', data)
            .done(success);
    });

    /**
     * Handle like button
     */
    $(document).on("click", '[data-toggle="membership-like-toggle"]', function (evt) {
        var ele = $(evt.currentTarget),
            data = ele.data('object'),
            eid = ele.data('eid');

        if(!K.authRequired()) return;

        function success(response) {
            if (eid) {
                $(eid).replaceWith(response.html);
            } else {
                ele.replaceWith(response.html);
            }
        }

        K.ajax('ajax/like/like/membership-like-toggle', data)
            .done(success);
    });
})(jQuery);