define([
    'base/core/pushstate',
    'base/core/tooltip',
    'base/core/utils',
    'base/core/toast',
    'base/core/cardhover',
    'base/core/hyves',
    'base/core/ajaxform',
    'base/core/picaso',
    'base/core/boot',
    'base/core/report',
    'base/core/paging',
    'base/core/options',
    'base/core/privacy'], function () {

    // expander
    $(document).on('click', '[data-toggle="expand"]', function(){
        var $this =  $(this),
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
            K.ajax(url, object)
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