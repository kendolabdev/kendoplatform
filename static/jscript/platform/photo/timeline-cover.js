define(['jquery'],function(){
    var _debug = true,
        toggle = {
            save: '[data-toggle="tl-cover-save"]',
            upload: '[data-toggle="tl-cover-upload"]',
            cancel: '[data-toggle="tl-cover-cancel"]',
            reposition: '[data-toggle="tl-cover-reposition"]',
            remove: '[data-toggle="tl-cover-remove"]'
        };

    function startEditing() {
        $('.user-tlh-ow').addClass('edit-mode');
    }

    function endEditing() {
        $('.user-tlh-ow').removeClass('edit-mode');
    }

    function startReposition(img) {
        startEditing();
        img.draggable({
            //containment: 'parent',
            scroll: false,
            axis: "y",
            cursor: "move",
            stop: function (event, ui) {
                var maxTop = 0;
                var minTop = img.parent().height() - img.height();
                var top = ui.position.top;
                if (top > maxTop) {
                    img.animate({
                        top: maxTop
                    }, 300);
                } else if (top < minTop) {
                    img.animate({
                        top: minTop
                    }, 300);
                }
            }
        });
    }

    function stopReposition(img) {
        endEditing();
        img.draggable("destroy");
    }

    $(document).on('click', toggle.remove, function () {
        var btn = $(this),
            outer = btn.closest('.user-cover-ow'),
            img = $('.user-cover-img');

        endEditing();

        var send = {
            parent: btn.data('object')
        };

        $kd.ajax('ajax/platform/photo/cover/remove', send)
            .success(function () {
                img.attr('src', '');
                outer.removeClass('has-cover');
            })
            .error();
    });

    $(document).on('click', toggle.reposition, function () {
        var img = $('.user-cover-img');

        requirejs(['primary/jqueryui'], function () {
            startReposition(img)
        });
    });

    $(document).on('click', toggle.save, function () {
        var btn = $(this),
            img = $('.user-cover-img'),
            send = {
                fileId: img.data('fid'),
                uploaded: img.data('uploaded'),
                parent: btn.data('object'),
                top: img.position().top,
                size: {
                    width: img.width(),
                    height: img.height()
                }
            };

        _debug && console.log(send);

        $kd.ajax('ajax/platform/photo/cover/save', send)
            .success(function (response) {
                stopReposition(img);
                endEditing();

                if (response.message) {
                    Toast.success(response.message);
                }

                if (response.url) {
                    fetchPage(response.url);
                }
            })
            .error();
    });

    $(document).on('click', toggle.cancel, function () {
        var img = $('.user-cover-img'),
            reset = img.attr('reset');

        endEditing();

        if (!reset) return false;

        img.prop('src', reset).css({
            backgroundImage: 'none'
        });
    });

    $(document).on('click', toggle.upload, function () {
        var btn = $(this),
            input = $(btn.data('target')),
            url = $kd.getUrl('ajax/platform/photo/upload/temp', {}),
            img = $('.user-cover-img');

        if (!img.attr('reset')) {
            img.attr('reset', img.attr('src'));
        }

        if (!input.data('upload')) {

            input.data('upload', new PhotosUpload(input, {
                url: url,
                fileName: 'fileUpload',
                onNewFile: function (eid, index, file, input, plugin) {
                    plugin.processQueue();
                },
                onUploadProgress: function (eid, pos, percentage, input) {
                    if (_debug) {
                        console.log({
                            eid: eid,
                            pos: pos,
                            percentage: percentage,
                            input: input
                        });
                    }
                },
                onUploadSuccess: function (eid, id, data, input) {
                    if (_debug) {
                        console.log(data);
                    }
                    img.prop('src', data.url)
                        .data('fid', data.id)
                        .data('uploaded', '1');
                    startReposition(img);
                }
            }));
        }

        /**
         * do not put trigger to callback function, it's not work since browsers security.
         */
        requirejs(['primary/jqueryui'], function () {
        });

        input.trigger('click');
    });

    // exports

    /**
     * export this function to called from server, when ?editcover=1&fileId=....
     */
    window.startDraggableTimelineCoverImgForEdit = function () {
        requirejs(['primary/jqueryui'], function () {
            startReposition($('.user-cover-img'));
        });
    }
});