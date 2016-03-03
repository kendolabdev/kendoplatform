define(['jquery'],function(){
    $(document).on('click', '[data-toggle="photo-make-album-cover"]', function () {
        var ele = $(this),
            data = ele.data('object');

        $kd.ajax('ajax/platform/photo/photo/make-album-cover', data)
            .done(function (response) {
                if (response.message) {
                    Toast.success(response.message);
                }
            });
    });

    $(document).on('click', '[data-toggle="photo-delete"]', function () {
        var ele = $(this),
            data = ele.data('object'),
            eid = ele.data('eid'),
            wrap = $(eid).closest('.card-wrap')
            ;

        wrap.animate({opacity: 0}, 200, function () {
            wrap.remove()
        });

        $kd.ajax('ajax/platform/photo/photo/delete-photo', data)
            .done(function (response) {
                if (response.message) {
                    Toast.success(response.message);
                }
            })
    });

    $(document).on('click', '[data-toggle="photo-make-profile-photo"]', function () {
        var data = $(this).data('object');

        $kd.modal('ajax/platform/photo/avatar/edit-avatar-dialog', data);
    });
});