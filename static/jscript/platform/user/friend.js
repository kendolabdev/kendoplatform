define(['jquery'],function(){
    var toggle = {
        request: '[data-toggle="btn-friend-request"]',
        accept: '[data-toggle="btn-friend-accept"]',
        deny: '[data-toggle="btn-friend-ignore"]',
        cancel: '[data-toggle="btn-friend-cancel"]',
        remove: '[data-toggle="btn-friend-remove"]'
    };

    $(document).on('click', toggle.request, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/user/friend/request', {
            friendId: friendId
        }).always(function () {
            btn.prop('disabled', false)
        }).done(function (response) {
            btn.closest('.btn-membership').replaceWith(response.html);
        });
    });

    $(document).on('click', toggle.deny, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend'),
            eid = btn.data('eid');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/user/friend/ignore', {
            friendId: friendId
        }).always(function () {
            btn.prop('disabled', false)
        }).done(function (response) {
            $(eid).replaceWith(response.html);
        });
    });


    $(document).on('click', toggle.accept, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend'),
            eid = btn.data('eid');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/user/friend/accept', {
            friendId: friendId,
        }).always(function () {
            btn.prop('disabled', false)
        }).done(function (response) {
            $(eid).replaceWith(response.html);
        });
    });

    $(document).on('click', toggle.cancel, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/user/friend/cancel', {
            friendId: friendId
        }).always(function () {
            btn.prop('disabled', false)
        }).done(function (response) {
            btn.closest('.btn-membership').replaceWith(response.html);
        });
    });

    $(document).on('click', toggle.remove, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend'),
            eid = btn.data('eid');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/user/friend/remove', {
            friendId: friendId
        }).done(function (response) {
            $(eid).replaceWith(response.html);
        });
    });
});