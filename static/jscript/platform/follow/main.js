define(['jquery'], function () {
    $(document).on('click', '[data-toggle="btn-follow"]', function (evt) {
        var btn = $(this),
            data = btn.data('object'),
            ctx = btn.hasClass('btn') ? 'btn' : 'menu';

        if (btn.prop('disabled')) return;

        btn.prop('disabled', true);

        data.ctx = ctx;

        K.ajax('ajax/follow/follow/toggle', data)
            .done(function (res) {
                btn.closest('.btn-follow').replaceWith(res.html);
            }).always(function () {
            btn.prop('disabled', false);
        });
    });

    $(document).on('click', '[data-toggle="link-toggle-follow"]', function (evt) {
        var ele = $(evt.currentTarget),
            data = ele.data('object');

        evt.preventDefault();

        if (ele.prop('disabled')) return;

        ele.prop('disabled', true);

        K.ajax('ajax/follow/follow/link-toggle', data)
            .always(function () {
                ele.prop('disabled', false)
            }).done(function (response) {
            _debug && console.log(response);
            ele.html(response.html);
        });
    });
});