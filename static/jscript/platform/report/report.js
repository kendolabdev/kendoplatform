define(['jquery','underscore'],function(){
    (function ($, _) {
        $(document).on('click', '[data-toggle="btn-report"]', function () {
            var ele = $(this),
                data = ele.data('object');

            if (_.isEmpty(data)) {
                $kd.modal('ajax/platform/report/general-report/dialog', data);
            } else {
                $kd.modal('ajax/platform/report/report/dialog', data);
            }
        })
    })(jQuery, _);
});