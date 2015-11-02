(function ($, _) {
    var LinkComposer,
        _dataKey ='linkComposer';

    LinkComposer = function (ele) {
        var _form= $(ele),
            loading = false,
            attatched = false,
            triedLinks = []
            ;
        _form.on('onLinkAttatch', function (evt, data) {
            if (loading) return;
            if (attatched) return;

            var checkLink = false;
            /**
             * check links
             */
            for (var index in data.links) {
                var temp = data.links[index].trim();
                if (false == _.contains(triedLinks, temp)) {
                    checkLink = temp;
                    break;
                }
            }
            if (checkLink) {
                parse(checkLink);
            }
        });

        _form.on('onRemoveAttachment', function () {
            clean();
        }).on('clean', function () {
            clean();
        }).on('clearBootInit',function(){
            _form.data(_dataKey, false);
        });

        function clean() {
            loading = false;
            attatched = false;
            triedLinks = [];

            $('.composer-preview-link', _form).remove();
        }

        /**
         * call success
         * @param data
         */
        function success(data) {
            if (attatched) return;

            if (data.code == 200) {
                attatched = true;
                _form.find('.fc-att-ow').append(data.html);
            } else {
                // do nothing
            }
        }

        /**
         * parse link failed
         */
        function error() {
            console.log('Could not parse url ');
        }

        /**
         * complete
         */
        function complete() {
            loading = false;
            _form.trigger('onLoading:done');
        }

        function parse(link) {
            if (loading) return;

            loading = true;
            link = link.trim();

            triedLinks.push(link);

            _form.trigger('onLoading:start');

            K.ajax('ajax/core/link/composer-preview', {url: link})
                .done(success)
                .error()
                .complete(complete);
        }
    };

    /**
     * Remove attachment area
     */
    $(document).on('click', '[data-toggle="fc-attatch-remove"]', function (evt) {
        var ele = $(evt.currentTarget);
        ele.closest('form').trigger('onRemoveAttachment');

    });

    /**
     * Toggle attachment
     */
    $(document).on('click', '[data-toggle="fc-attatch-as-link"]', function (evt) {
        var ele = $(evt.currentTarget),
            outer = ele.closest('.composer-preview-link');

        if (outer.hasClass('as-video')) {
            outer.removeClass('as-video').addClass('as-link');
            $('.attachment-type',outer).val('link');
            ele.text(ele.data('label2'));
        } else {
            outer.removeClass('as-link').addClass('as-video');
            ele.text(ele.data('label1'));
            $('.attachment-type',outer).val('video');
        }
    });

    $.fn.linkComposer = function () {
        this.data(_dataKey) || this.data(_dataKey, new LinkComposer(this));
    };
})(jQuery, _);