(function ($) {
    var Core;

    Core = {
        /**
         * Base options
         */
        options: {
            baseUrl: '/',
            logged: false,
            isUser: false
        },
        /**
         * Set options
         * @param options
         */
        setOptions: function (options) {
            console.log('setOptions', options);
            this.options = $.extend({}, this.options, options);
        },
        /**
         * get options
         * @returns {*}
         */
        getOptions: function () {
            return this.options;
        },
        /**
         * @returns {string}
         */
        getBaseUrl: function () {
            return this.options.baseUrl;
        },
        /**
         *
         * @param {string} url
         * @param {object|undefined|string} data
         * @returns {string}
         */
        getUrl: function (url, data) {

            var h = '';

            if (typeof data == 'string') {
                h = '?' + data;
            } else if (typeof data == 'object') {
                h = '?' + $.param(data);
            }

            return this.getBaseUrl() + url.replace(/^\/+/, '') + h;
        },
        /**
         * Open modal box
         * @param url
         * @param data
         */
        modal: function (url, data) {
            data = $.extend({isDialog: true}, data);
            return K.ajax(url, data)
                .done(function (response) {
                    Hyves.create(response.html).show();
                });
        },
        /**
         * Close model box
         */
        closeModal: function () {
            Hyves.destroy();
        },
        /**
         * General id then
         * @param {string} prefix
         * @param {number} count
         * @returns {string}
         */
        newId: function (prefix, count) {
            if (typeof count == 'undefined') {
                count = 10;
            }
            if (typeof prefix == 'undefined') {
                prefix = '_';
            }

            if (prefix == '') {
                prefix = '_';
            }

            var response = prefix;

            var seek = 'qwertyuiopasdfghjklzxcvbnm';
            var max = seek.length;
            for (var i = 0; i < count; ++i) {
                response += seek.charAt(Math.round(Math.random() * max));
            }
            return response;
        },
        /**
         * Generate new id for an element
         * @param {Element} e element
         * @param {string} prefix
         * @returns {string}
         */
        idIfNot: function (e, prefix) {
            if (!e.attr('id')) {
                e.attr('id', this.newId(prefix))
            }
            return e.attr('id');
        },
        /**
         * Create ajax request
         * @param url
         * @param data
         * @returns {jQuery.ajax}
         */
        ajax: function (url, data) {
            return $.ajax({
                url: K.getUrl(url),
                data: arguments[1],
                method: 'post',
                dataType: 'json'
            });
        },
        /**
         * Current viewer logged?
         *
         * @returns {boolean}
         */
        logged: function () {
            return this.options.logged
        },
        /**
         * Current viewer is user
         *
         * @returns {boolean}
         */
        isUser: function () {
            return this.options.isUser
        },
        authRequired: function () {
            if (!this.logged()) {
                this.modal('ajax/user/auth/login-dialog', {msg: 'core.login_required'});
                return false;
            }
            return true;
        }
    };
    window.K = Core;
})(window.jQuery, window);

// timeline cover photo
(function ($) {
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

        K.ajax('ajax/photo/cover/remove', send)
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

        K.ajax('ajax/photo/cover/save', send)
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
            url = K.getUrl('ajax/photo/upload/temp', {}),
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
})(window.jQuery);

(function ($) {

    var AvatarField = {
        init: function () {
            var previewImg = $('.field-preview-img');
            var cropImg = $('.field-crop-img');
            var hiddenValue = $('input.avatar-value');
            var value = hiddenValue.val();

            if (!value) return;

            var arr = value.split(';');

            var coords = {
                x: arr[2],
                y: arr[3],
                w: arr[6],
                h: arr[7]
            };

            var rx = 100 / coords.w;
            var ry = 100 / coords.h;

            var img = previewImg.get(0);

            var w = arr[10], h = arr[11];

            previewImg.css({
                width: Math.round(rx * w) + 'px',
                height: Math.round(ry * h) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
        }
    };

    window.AvatarField = AvatarField;

    var toggle = {
        upload: '[data-toggle="btn-avatar-upload"]'
    };


    $(document).on('click', toggle.upload, function (e) {
        var btn = $(e.currentTarget),
            input = $(btn.data('target')),
            outer = input.closest('.field-avatar-ow'),
            url = K.getUrl('ajax/photo/upload/temp', {}),
            hiddenValue = $('input.avatar-value', outer),
            cropImg = $('.field-crop-img', outer),
            previewImg = $('.field-preview-img', outer),
            cropApi;

        if (!cropImg.attr('reset')) {
            cropImg.attr('reset', cropImg.attr('src'));
        }

        function updateData(coords, nx, ny, dim) {
            var opts = hiddenValue.data('opts');
            var value = [opts.type, opts.id, coords.x, coords.y, coords.x2, coords.y2, coords.w, coords.h, dim[0], dim[1], nx, ny].join(';');
            hiddenValue.val(value);
        }

        function showPreview(coords) {
            var rx = 100 / coords.w;
            var ry = 100 / coords.h;

            var img = previewImg.get(0);

            var w = img.naturalWidth;
            var h = img.naturalHeight;

            updateData(coords, w, h, cropApi.getBounds());

            previewImg.css({
                width: Math.round(rx * w) + 'px',
                height: Math.round(ry * h) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
        }

        function enableCrop(img) {
            img.Jcrop({
                onSelect: showPreview,
                onChange: showPreview,
                aspectRatio: 1.0,
                allowSelect: true,
                minSize: [120, 120],
                maxSize: [320, 320]
            }, function () {
                cropApi = this;
                cropApi.focus();
                var dim = cropApi.getBounds();
                var size = 220;
                var startX = Math.ceil((dim[0] - size) / 2);
                var startY = Math.ceil((dim[1] - size) / 2);

                cropApi.setSelect([
                    startX, startY, startX + size, startY + size
                ]);
            });
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
                    var opts = {
                        type: 'temp',
                        id: data.id
                    }

                    hiddenValue.data('opts', opts);
                    cropImg.prop('src', data.url);
                    previewImg.prop('src', data.url);
                    enableCrop(cropImg);
                }
            }));
        }
        input.trigger('click');
    });
})(window.jQuery);

(function ($) {
    var toggle = {
        request: '[data-toggle="btn-friend-request"]',
        accept: '[data-toggle="btn-friend-accept"]',
        deny: '[data-toggle="btn-friend-ignore"]',
        cancel: '[data-toggle="btn-friend-cancel"]',
        remove: '[data-toggle="btn-friend-remove"]'
    };

    $(document).on('click', toggle.request, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend');

        btn.prop('disabled', true);

        K.ajax('/ajax/user/friend/request', {
            friendId: friendId
        }).always(function () {
            btn.prop('disabled', false)
        }).done(function (response) {
            btn.closest('.btn-membership').replaceWith(response.html);
        });
    });

    $(document).on('click', toggle.deny, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend'),
            eid = btn.data('eid');

        btn.prop('disabled', true);

        K.ajax('/ajax/user/friend/ignore', {
            friendId: friendId
        }).always(function () {
            btn.prop('disabled', false)
        }).done(function (response) {
            $(eid).replaceWith(response.html);
        });
    });


    $(document).on('click', toggle.accept, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend'),
            eid = btn.data('eid');

        btn.prop('disabled', true);

        K.ajax('/ajax/user/friend/accept', {
            friendId: friendId,
        }).always(function () {
            btn.prop('disabled', false)
        }).done(function (response) {
            $(eid).replaceWith(response.html);
        });
    });

    $(document).on('click', toggle.cancel, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend');

        btn.prop('disabled', true);

        K.ajax('/ajax/user/friend/cancel', {
            friendId: friendId
        }).always(function () {
            btn.prop('disabled', false)
        }).done(function (response) {
            btn.closest('.btn-membership').replaceWith(response.html);
        });
    });

    $(document).on('click', toggle.remove, function (evt) {
        var btn = $(evt.currentTarget),
            friendId = btn.data('friend'),
            eid = btn.data('eid');

        btn.prop('disabled', true);

        K.ajax('/ajax/user/friend/remove', {
            friendId: friendId
        }).done(function (response) {
            $(eid).replaceWith(response.html);
        });
    });
})(window.jQuery);

(function ($) {
    var toggle = {
        add: '[data-toggle="btn-like-add"]',
        remove: '[data-toggle="btn-like-remove"]'
    };

    $(document).on('click', toggle.add, function () {
        var btn = $(this),
            obj = btn.data('object');

        btn.prop('disabled', true);

        K.ajax('/ajax/like/like/add', {
            id: obj.id,
            type: obj.type,
            context: 'btn'
        }).done(function (result) {
            btn.closest('.btn-like-ow').html(result.html);
        }).error(function (result) {
            console.log(result);
        });
    });

    $(document).on('click', toggle.remove, function () {
        var btn = $(this),
            obj = btn.data('object');

        btn.prop('disabled', true);

        K.ajax('/ajax/like/like/remove', {
            id: obj.id,
            type: obj.type,
            context: 'btn'
        }).done(function (result) {
            btn.closest('.btn-like-ow').html(result.html);
        }).error(function (result) {
            console.log(result);
        });
    });
})(window.jQuery);


// Group membership register
(function ($) {
    var toggle = {
        join: '[data-toggle="btn-group-join"]',
        leave: '[data-toggle="btn-group-leave"]',
        accept: '[data-toggle="btn-group-accept"]',
        ignore: '[data-toggle="btn-group-ignore"]',
        cancel: '[data-toggle="btn-group-cancel"]',
        remove: '[data-toggle="btn-group-remove"]'
    };

    $(document).on('click', toggle.join, function (evt) {
        var btn = $(this),
            obj = btn.data('object');

        K.ajax('/ajax/group/membership/join', {
            id: obj.id,
            type: 'group',
            context: 'btn'
        }).done(function (result) {
            if (btn.data('eid')) {
                $(btn.data('eid')).replaceWith(result.html)
            } else {
                btn.replaceWith(result.html)
            }
        }).error(function (result) {
            console.log(result);
        });
    });

    $(document).on('click', toggle.cancel, function (evt) {
        var btn = $(evt.currentTarget);
        var obj = btn.data('object');

        K.ajax('/ajax/group/membership/cancel', {
            id: obj.id,
            type: 'group',
            context: 'btn'
        }).done(function (result) {
            if (btn.data('eid')) {
                $(btn.data('eid')).replaceWith(result.html)
            } else {
                btn.replaceWith(result.html)
            }
        }).error(function (result) {
            console.log(result);
        });
    });

    $(document).on('click', toggle.ignore, function (evt) {
        var btn = $(this),
            obj = btn.data('object');

        obj.context = 'btn';

        K.ajax('/ajax/group/membership/ignore', obj)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
                console.log(result);
            });
    });

    $(document).on('click', toggle.accept, function (evt) {
        var btn = $(evt.currentTarget),
            obj = btn.data('object');

        obj.context = 'btn';

        K.ajax('/ajax/group/membership/accept', obj)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
                console.log(result);
            });
    });

    $(document).on('click', toggle.remove, function (evt) {
        var btn = $(evt.currentTarget),
            obj = btn.data('object');

        obj.context = 'btn';

        K.ajax('/ajax/group/membership/remove', obj)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
                console.log(result);
            });
    });

    $(document).on('click', '[data-toggle="btn-invitation-cmd"]', function (e) {
        var btn = $(e.currentTarget),
            data = $.extend({}, btn.data('obj'), {ctx: btn.data('ctx'), cmd: btn.data('cmd')});

        e.preventDefault();

        btn.prop('disabled', true);

        btn.closest('.card-invitation').addClass('hidden');

        K.ajax('ajax/invitation/invitation/cmd', data)
            .always(function () {
                btn.prop('disabled', false);
            }).done(
            function (result) {
            }
        ).error(function () {
            });

    });

    $(document).on('click', '[data-toggle="modal"]', function (e) {
        var btn = $(e.currentTarget),
            url = btn.data('remote'),
            obj = btn.data('object');

        K.modal(url, obj);
    });

    // method is deprecated, its now moved to paging items.
    if (false) {
        $(window).on('scroll', function () {
            // scrol to end
            var win = $(window),
                delta = 100,
                isEnding = $(document).height() - (win.scrollTop() + win.height()) < delta
                ;
            if (isEnding) {
                $('[data-endless="true"]').trigger('loadmore');
            }
        });
    }

})(jQuery);