(function ($) {
    var LiveChat, toggle;

    LiveChat = function () {
        this.chatList = [];
    };

    toggle = {
        open: '[data-toggle="btn-open-chat"]',
        close: '[data-toggle="btn-chat-conf-close"]'
    };

    /**
     * click on open chat
     * `data-toggle="btn-open-chat"`
     *
     */
    $(document).on('click', toggle.open, function (e) {
        var btn = $(e.currentTarget);
        var obj = btn.data('object');

        K.ajax('ajax/message/chat/open', obj)
            .complete()
            .done(function (result) {
                $('#docklet-ow').prepend(result.html);
            })
            .error();
    });

    /**
     * Click on -close popup button
     *
     */
    $(document).on('click', toggle.close, function (e) {
        var btn = $(e.currentTarget);
        btn.closest('.chat-popup').remove();


    });
    window.Chat = new LiveChat();
})(jQuery);