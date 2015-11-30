(function ($) {

    var _debug = false;
    /**
     * Proxy submit form to ajax form
     */
    $(document).on('submit', '[async]', function (evt) {
        evt.preventDefault();
        var form = $(this),
            data = form.serializeJSON(),
            url = form.data('action'),
            _default = {directive: 'close'}, result = {};

        _debug && console.log('post data url ', url, data);

        K.ajax(url, data)
            .always(function(){
                _debug && console.log(arguments)
            })
            .done(function (response) {
                result = $.extend({}, _default, response);
                switch (result.directive) {
                    case 'close':
                        K.closeModal();
                        break;
                    case 'update':
                        form.closest('.hyves-stagein')
                            .html(response.html)
                            .bootInit();
                        break;
                    case 'reload':
                        K.closeModal();
                        window.location.reload();
                        break;
                }
            });
    });
})(jQuery);