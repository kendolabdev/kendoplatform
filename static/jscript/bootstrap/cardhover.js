(function ($, _) {
    var debug = false,
        toggle = '[data-hover="card"]',
        _Dialog,
        defaults = {
            timeoutOpen: 1000,
            timeoutClose: 250,
            enabledAdmin: false
        },
        _dialogTpl = '<div class="cardhover-dialog hidden"><div class="cardhover-overlay"><div class="cardhover-stageout"><div class="cardhover-stagein"><div class="cardhover-content"></div></div></div><div class="cardhover-tailer"><div></div></div></div></div>';

    _Dialog = function (options) {
        var cached = {},
            timeoutOpenId = 0,
            timeoutCloseId = 0,
            settings = $.extend(defaults, options),
            element = false,
            cardInfo = '',
            clientX = 0,
            clientY = 0,
            isRunning = false,
            isShowing = false,
            isMouseOver = false,
            dialog,
            dialogContent
            ;

        debug && console.log("Init cardhover");


        /**
         * Clear Cache
         * @param {string} card
         */
        this.clearCache = function (card) {
            if (cached.hasOwnProperty(card))
                delete(cached[card]);
        };

        function prepareToHideDialog(flag) {
            isMouseOver = flag;
            if (timeoutCloseId) {
                try {
                    window.clearTimeout(timeoutCloseId);
                } catch (e) {

                }

            }

            if (timeoutOpenId) {
                try {
                    window.clearTimeout(timeoutOpenId);
                } catch (e) {
                }
            }

            timeoutCloseId = 0;
            timeoutOpenId = 0;

            if (flag == 0) {
                cardInfo = '';
                timeoutCloseId = window.setTimeout(hideDialog, settings.timeoutClose);
            }
        }

        /**
         * Request Popup Data
         */
        function requestPopup() {

            var url = 'cardhover/' + cardInfo.replace('@', '/');

            K.ajax(url, {cardInfo: cardInfo})
                .complete(onRequestComplete)
                .done(onRequestSuccess)
                .error(onRequestError);

            startSending();
        }

        function hideDialog() {
            if (!dialog) return;
            dialog.addClass('hidden');
            isShowing = false;
        }

        function closeDialog() {
            if (timeoutOpenId) {
                try {
                    window.clearTimeout(timeoutOpenId);
                } catch (e) {
                }
            }
            if (timeoutCloseId) {
                try {
                    window.clearTimeout(timeoutCloseId);
                } catch (e) {
                }
            }
            timeoutOpenId = 0;
            timeoutCloseId = 0;
            dialog.addClass('hidden');
            isShowing = false;
        }

        /**
         * Start sending
         */
        function startSending() {
            if (timeoutCloseId) {
                try {
                    window.clearTimeout(timeoutCloseId);
                } catch (e) {
                }
            }
            timeoutCloseId = 0;
            dialogContent.html('<div class="cardhover-content">Loading...</div>');
            updateDialogPosition(1);
        }

        function onRequestComplete() {

        }

        function onRequestError() {
            closeDialog();
        }

        /**
         *
         * @param data
         * @returns {*}
         */
        function onRequestSuccess(data) {
            if (_.isEmpty(data)
                || _.isEmpty(data.cardInfo)
                || _.isEmpty(data.html)
                || data.cardInfo != cardInfo) {
                hideDialog();
                return false;
            } else {
                updateDialogPosition();
                dialogContent.html(data.html);
                dialog.removeClass('hidden');
            }
        }

        /**
         *
         * @param evt
         * @param ele
         * @param info  Card information format "id@type"
         */
        function prepareToShowDialog(evt, ele, info) {
            element = ele;
            cardInfo = info;

            if (timeoutOpenId) {
                try {
                    window.clearTimeout(timeoutOpenId);
                } catch (e) {

                }
            }

            isRunning = false;
            clientX = evt.clientX;
            clientY = evt.clientY;

            timeoutOpenId = window.setTimeout(requestPopup, settings.timeoutOpen);
        }

        /**
         * Update dialog poistion
         * @param flag
         */
        function updateDialogPosition(flag) {
            isShowing = true;

            if (!element) return;

            var offset = element.offset(),
                css = {
                    left: 0,
                    top: 0
                },
                size = {
                    width: element.width(),
                    height: element.height()
                },
                winWidth = $(window).width();

            if (clientY > 280) {
                css.top = offset.top;
                dialog.removeClass('down').addClass('up');
            } else {
                css.top = offset.top + size.height;
                dialog.removeClass('up').addClass('down');
            }


            if (document.dir == 'ltr') {
                // check the position of the content
                if (winWidth - clientX > 350) {
                    dialog.removeClass('left').addClass('right');
                    css.left = size.width > 200 ? clientX : offset.left;
                } else {
                    dialog.removeClass('right').addClass('left');
                    css.left = size.width > 200 ? clientX : (offset.left + size.width);
                }
            } else {
                // right to left
                if (clientX < 310) {
                    css.left = size.width > 200 ? clientX : offset.left;
                    dialog.removeClass('left').addClass('right');
                } else {
                    css.left = size.width > 200 ? clientX : (offset.left + size.width);
                    dialog.removeClass('right').addClass('left');
                }

            }

            dialog.css(css)

            if (flag) {
                dialog.removeClass('hidden');
            }
        }

        function createDialog() {

            dialog = $(_.template(_dialogTpl)()).appendTo('body');
            dialogContent = $('.cardhover-content', dialog);

            dialog.on('mouseover', function () {
                prepareToHideDialog(1);
            }).on('mouseout', function () {
                prepareToHideDialog(0);
            });
        }

        /**
         * Initialize object
         */
        function initialize() {
            createDialog();
        };

        /**
         * prepare to hide dialog
         */
        $(document).on('mouseout', toggle, function () {
            prepareToHideDialog(0);
        });

        $(document).on('pagechanged', function () {
            closeDialog();
        });

        /**
         * prepare to hide dialog
         */
        $(document).on('mouseover', toggle, function (evt) {
            var ele = $(evt.currentTarget),
                card = ele.data('card');

            if (!card) return;

            if (!/^\d+@\w+$/.test(card)) return;

            prepareToShowDialog(evt, ele, card);

        });

        $(document).ready(function () {
            initialize();
        });

        return this;
    };

    window.CardHover = new _Dialog({});
})(jQuery, _);