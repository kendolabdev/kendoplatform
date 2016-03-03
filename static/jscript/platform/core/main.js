define(['jquery'], function () {
    $(document).on('click', '[data-toggle="ajax"]', function (evt) {
        evt.preventDefault();

        var $this = $(this),
            url = $this.data('url'),
            data = $this.data('object');

        $kd.ajax(url, data)
            .done(function (result) {
                switch (result.directive) {
                    case 'success':
                        Toast.success(result.message);
                        break;
                    case 'error':
                        Toast.error(result.message);
                        break;
                    case 'warning':
                        Toast.warning(result.message);
                        break;
                    case 'reload':
                        window.location.reload();
                        break;
                }
            });
    });

    // expander
    $(document).on('click', '[data-toggle="expand"]', function () {
        var $this = $(this),
            $target = $($this.data('target'));
        $target.toggleClass('collapse');
    });

    $(document).on('click', '[data-toggle="dismiss"]', function () {
        var e = $(this),
            url = e.data('url'),
            eid = e.data('eid'),
            closest = e.data('closest') || '.card-wrap',
            object = e.data('object'),
            target = eid ? $(eid).closest(closest) : e.closest(closest);

        console.log(closest);

        target.animate({opacity: 0}, 200, function () {
            target.addClass('hidden');
        });

        if (url)
            $kd.ajax(url, object)
                .done(function (result) {
                    if (!_.isEmpty(result.success))
                        Toast.success(result.success);

                    if (!_.isEmpty(result.error)) {
                        Toast.error(result.error);
                        target.removeClass('hidden');
                    }
                });
    });

});