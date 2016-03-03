define(['jquery'],function(){
    $(document).on('click', '[data-toggle="btn-invitation-cmd"]', function (e) {
        var btn = $(e.currentTarget),
            data = $.extend({}, btn.data('obj'), {ctx: btn.data('ctx'), cmd: btn.data('cmd')});

        e.preventDefault();

        btn.prop('disabled', true);

        btn.closest('.card-invitation').addClass('hidden');

        $kd.ajax('ajax/platform/invitation/invitation/cmd', data)
            .always(function () {
                btn.prop('disabled', false);
            }).done(
            function (result) {
            }
        ).error(function () {
        });

    });
});