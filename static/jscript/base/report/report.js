(function ($, _) {
    $(document).on('click', '[data-toggle="btn-report"]', function () {
        var ele = $(this),
            data = ele.data('object');

        if (_.isEmpty(data)) {
            K.modal('ajax/report/general-report/dialog', data);
        } else {
            K.modal('ajax/report/report/dialog', data);
        }
    })
})(jQuery, _);