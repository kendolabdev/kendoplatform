define(['jquery', 'underscore'], function () {
    var _Hyves,
        _debug = false,
        _dialogTpl = '<div id="hyves-dialog" class="hyves-dialog"><div class="hyves-overlay" /><div class="hyves-stageout"><div class="hyves-stagein"></div></div></div>';

    /**
     * Hyves Constructor
     * @private
     */
    _Hyves = function () {
        this.element = null;
    }

    /**
     * Make default behavior from Hyves modal
     * @return {_Hyves}
     */
    _Hyves.prototype.make = function () {
        this.element = $(_.template(_dialogTpl)()).appendTo('body');
        this.element.find('.hyves-overlay').on('click', $.proxy(this.destroy, this));
        return this;
    }

    /**
     * Create Hyves modal
     * @param content
     * @returns {_Hyves}
     */
    _Hyves.prototype.create = function (content) {
        _debug && console.log("Destroy Hyves Dialog");

        this.make();

        this.element.find('.hyves-stagein:first').html(content);

        $(document)
            .on('closehyves', $.proxy(this.destroy, this))
            .on('page_change_start', $.proxy(this.destroy, this))
            .on('click', '[data-toggle="btn-hyves-close"]', $.proxy(this.destroy, this));

        return this;
    }

    /**
     * Show Hyves modal
     * @returns {_Hyves}
     */
    _Hyves.prototype.show = function () {

        _debug && console.log("Show Hyves Dialog");

        this.element.find('.hyves-body')
            .not('.hyves-body-full').css({
            maxHeight: Math.ceil($(window).height() - 200)
        });
        this.element.find('.paging')
            .not('paging-full')
            .css({
                maxHeight: Math.ceil($(window).height() - 200)
            });

        /**
         * fix boot init for loaded content.
         */
        this.element.bootInit();

        $('body').addClass('hyves-open');

        return this;
    }

    /**
     * Hide hyves modal dialog
     *
     * @returns {_Hyves}
     */
    _Hyves.prototype.hide = function () {

        _debug && console.log("Hide Hyves Dialog");

        $('body').removeClass('hyves-open');

        return this;
    }

    /**
     * Destroy Hyves modal dialog
     * @returns {_Hyves}
     */
    _Hyves.prototype.destroy = function () {

        if (!this.element) return this;

        _debug && console.log("Destroy Hyves Dialog");

        $('body').removeClass('hyves-open');

        this.element.remove();

        this.element = false;

        return this;
    }

    $(document).on('click', '[data-toggle="hyves"]', function () {
        var ele = $(this);
        $kd.modal(ele.data('remote') || ele.data('url'));
    });

    /**
     * Apply global object to hyves
     * @type {_Hyves}
     */
    window.Hyves = new _Hyves();
});