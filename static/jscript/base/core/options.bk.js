/**
 * Control options menu
 */
(function ($, _) {
    var _debug = true,
        _toggleOptions = '[data-toggle="btn-options"]',
        _Dialog,
        _waitingTime = 250,
        _dialogTpl = '<div class="options-dialog hidden"><div class="options-overlay"><div class="options-stageout"><div class="options-stagein"><div class="options-content"></div></div></div><div class="options-tailer"><div></div></div></div></div>',
        _loadingTpl = '<div class="options-content"><ul class="options-menu"><li class="options-loading">Loading...</li></ul></div>',
        _dataKey = 'options';

    _Dialog = function (ele, clientX, clientY) {
        this.element = $(ele);
        this.dialog = false;
        this.clientY = clientY;
        this.forItem = this.element.data('for') || 'for-icon';
        this.forBeeber = /beeber/i.test(this.element.data('for')) ? true : false;
    };

    /**
     *
     */
    _Dialog.prototype.hideDialog = function () {
        if (!this.dialog || !this.dialog.length) return;
        this.dialog.addClass('hidden');
    }

    /**
     *
     */
    _Dialog.prototype.showDialog = function () {
        this.dialog.removeClass('hidden');
    }

    /**
     *
     */
    _Dialog.prototype.closeDialog = function () {
        this.dialog.addClass('hidden');
    }

    /**
     * Update dialog position
     */
    _Dialog.prototype.updateDialogPosition = function () {

        _debug && console.log("_OptionsDialog updateDialogPosition");

        if (!this.element) return;

        var offset = this.element.offset(),
            isLeft = /left/i.test(this.element.data('for')) ? true : false,
            alignX = isLeft ? 'left' : 'right',
            alignY = 'down',
            left = offset.left + Math.ceil(this.element.outerWidth() / 2),
            top = offset.top + this.element.outerHeight();

        if (this.forItem == 'for-btn') {
            if (isLeft) {
                left = offset.left;
            } else {
                left = offset.left + this.element.outerWidth();
            }
        }

        if (_debug) {
            console.log('offset', offset);
            console.log('element width', this.element.width());
            console.log('element height', this.element.height())
        }

        if (this.forBeeber && window.innerWidth < 380) {
            if (isLeft) {
                left = 0;
                this.dialog.find('.options-overlay').css({left:0});
            } else {
                left = window.innerWidth;
                this.dialog.find('.options-overlay').css({right:0});
                this.dialog.find('.options-tailer')
                    .css({left: 'auto',right: Math.ceil(window.innerWidth - offset.left - this.element.outerWidth()/2-10)});
            }

        }

        if (this.clientY > 280) {
            top = offset.top;
            alignY = 'up';
        }

        this.dialog.addClass(alignX).addClass(alignY).css({left: left, top: top});
    }

    /**
     *
     */
    _Dialog.prototype.createDialog = function () {

        _debug && console.log("_OptionsDialog createDialog");

        this.dialog = $(_.template(_dialogTpl)()).appendTo('body');

        this.dialog.addClass(this.element.data('for'));

        this.dialog.on('hide', $.proxy(this.hideDialog, this));

        this.loadContent();

    }

    /**
     * Load content
     */
    _Dialog.prototype.loadContent = function () {

        if (!this.dialog) return;
        var that = this,
            url = this.element.data('remote'),
            eid = '#' + this.element.eid(),
            obj = $.extend({eid: eid}, this.element.data('object'));

        function loadSuccess(response) {
            that.dialog.find('.options-stagein')
                .html(response.html);
        }

        K.ajax(url, obj)
            .done(loadSuccess);
    }

    /***
     * Open dialog from this data
     */
    _Dialog.prototype.toggleDialog = function () {

        _debug && console.log("_OptionsDialog openDialog");

        if (!this.dialog) {
            this.createDialog();
            $('.options-stagein', this.dialog).html(_.template(_loadingTpl)());
        }

        this.updateDialogPosition();

        /**
         * Check to show later
         */
        if (this.dialog.hasClass('hidden')) {
            var that = this;

            window.setTimeout(function () {
                that.showDialog();
            }, _waitingTime);
        }
    }

    /**
     * clear menu
     */
    function clearMenus() {
        $('.options-dialog').trigger('hide');
        _debug && console.log("clear menu drop downs");
    }

    /**
     * Register global function
     */
    $(document).on('click', function (evt) {
        if(!evt.isDefaultPrevented()) clearMenus();
    }).on('pagechanged', function () {
        clearMenus();
    }).on('click', _toggleOptions, function (evt) {
        var ele = $(evt.currentTarget),
            instance = ele.data(_dataKey);

        if (!instance) {
            ele.data(_dataKey, instance = new _Dialog(evt.currentTarget, evt.clientX, evt.clientY));
        }
        instance.toggleDialog();
    });
})(jQuery, _);