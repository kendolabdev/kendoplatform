define(['jquery'],function(){
    var toggle = {
        join: '[data-toggle="btn-group-join"]',
        leave: '[data-toggle="btn-group-leave"]',
        accept: '[data-toggle="btn-group-accept"]',
        ignore: '[data-toggle="btn-group-ignore"]',
        cancel: '[data-toggle="btn-group-cancel"]',
        remove: '[data-toggle="btn-group-remove"]'
    };

    $(document).on('click', toggle.join, function (evt) {
        var btn = $(this),
            obj = btn.data('object');

        K.ajax('/ajax/group/membership/join', {
            id: obj.id,
            type: 'group',
            context: 'btn'
        }).done(function (result) {
            if (btn.data('eid')) {
                $(btn.data('eid')).replaceWith(result.html)
            } else {
                btn.replaceWith(result.html)
            }
        }).error(function (result) {
            console.log(result);
        });
    });

    $(document).on('click', toggle.cancel, function (evt) {
        var btn = $(evt.currentTarget);
        var obj = btn.data('object');

        K.ajax('/ajax/group/membership/cancel', {
            id: obj.id,
            type: 'group',
            context: 'btn'
        }).done(function (result) {
            if (btn.data('eid')) {
                $(btn.data('eid')).replaceWith(result.html)
            } else {
                btn.replaceWith(result.html)
            }
        }).error(function (result) {
            console.log(result);
        });
    });

    $(document).on('click', toggle.ignore, function (evt) {
        var btn = $(this),
            obj = btn.data('object');

        obj.context = 'btn';

        K.ajax('/ajax/group/membership/ignore', obj)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    });

    $(document).on('click', toggle.accept, function (evt) {
        var btn = $(evt.currentTarget),
            obj = btn.data('object');

        obj.context = 'btn';

        K.ajax('/ajax/group/membership/accept', obj)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    });

    $(document).on('click', toggle.remove, function (evt) {
        var btn = $(evt.currentTarget),
            obj = btn.data('object');

        obj.context = 'btn';

        K.ajax('/ajax/group/membership/remove', obj)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    });
});