define(['jquery'], function () {

    var toggle = {
        add: '[data-toggle="btn-like-add"]',
        remove: '[data-toggle="btn-like-remove"]'
    };

    $(document).on('click', toggle.add, function () {
        var btn = $(this),
            obj = btn.data('object');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/like/like/add', {
            id: obj.id,
            type: obj.type,
            context: 'btn'
        }).done(function (result) {
            btn.closest('.btn-like-ow').html(result.html);
        }).error(function (result) {
            console.log(result);
        });
    });

    $(document).on('click', toggle.remove, function () {
        var btn = $(this),
            obj = btn.data('object');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/like/like/remove', {
            id: obj.id,
            type: obj.type,
            context: 'btn'
        }).done(function (result) {
            btn.closest('.btn-like-ow').html(result.html);
        }).error(function (result) {
            console.log(result);
        });
    });

    /**
     * Handle like button
     */
    $(document).on("click", '[data-toggle="btn-like"]', function (evt) {
        var ele = $(evt.currentTarget),
            data = ele.data('object'),
            stage = ele.closest('.card-feed');

        if (!$kd.authRequired()) return;

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

        $kd.ajax('ajax/platform/like/like/toggle', data)
            .done(success);
    });

    /**
     * Handle like button
     */
    $(document).on("click", '[data-toggle="like-comment-toggle"]', function () {
        var ele = $(this),
            data = ele.data('object'),
            stage = ele.closest('.fs-cm-asset');

        if (!$kd.authRequired()) return;

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

        $kd.ajax('ajax/platform/like/like/toggle', data)
            .done(success);
    });

    /**
     * Handle like button
     */
    $(document).on("click", '[data-toggle="membership-like-toggle"]', function (evt) {
        var ele = $(evt.currentTarget),
            data = ele.data('object'),
            eid = ele.data('eid');

        if (!$kd.authRequired()) return;

        function success(response) {
            if (eid) {
                $(eid).replaceWith(response.html);
            } else {
                ele.replaceWith(response.html);
            }
        }

        $kd.ajax('ajax/platform/like/like/membership-like-toggle', data)
            .done(success);
    });
});