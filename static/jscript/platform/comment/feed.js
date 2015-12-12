define(['jquery'],function(){
    $(document).on('click', '[data-toggle="comment-remove"]', function () {
        var ele = $(this),
            data = ele.data('object'),
            eid = ele.data('eid'),
            stage = $(eid).closest('.cmt-item');

        if(!K.authRequired()) return;

        stage.animate({opacity:0},500, function(){stage.addClass('hidden')})

        ele.prop('disabled');

        K.ajax('ajax/comment/comment/remove', data)
            .always(function () {
                ele.prop('disabled', false)
            })
            .done(function (response) {
                if(response.code != 200){
                    stage.removeClass('hidden').animate({opacity:1});
                }
            });
    });

    $(document).on('click', '[data-toggle="comment-edit"]', function () {
        var ele = $(this),
            data = ele.data(),
            eid = ele.data('eid');

        if(!K.authRequired()) return;

        K.ajax('ajax/comment/comment/inline-edit', data)
            .done(function () {
            });
    });

    /**
     * Handle comment button
     */
    $(document).on('click', '[data-toggle="btn-comment"]', function (evt) {
        var ele = $(evt.target),
            stage = ele.closest('.feed-item'),
            form = stage.find('.fs-cmf-ow');

        if(!K.authRequired()) return;

        form.removeClass('hidden');
        form.find('.fc-mention-input').focus();
    });

    /**
     * view more comments
     */
    $(document).on('click', '[data-toggle="comment-more"]', function (evt) {
        var ele = $(this),
            loading = ele.data('loading'),
            obj = ele.data('object'),
            stage = ele.closest('.card-footer'),
            cmts = stage.find('.cmt-item'),
            parent = ele.closest('div'),
            ids = [];


        if (loading) return;

        cmts.each(function (i, e) {
            var id = $(e).data('id');
            if (!/undefined/.test(id))ids.push(id)
        });

        var sendData = $.extend({}, obj, {excludes: ids});
        // how to exclude exists data

        /**
         * @param response
         */
        function onSuccess(response) {

            if (response.html == "") {
                ele.closest('div').addClass('hidden');
            } else {
                $(response.html).insertBefore($('.cmt-item:first', stage));
                var total = response.commentCount,
                    counter = $('.cmt-item', stage).length,
                    cmds = $(response.cmds);

                $('.counter', cmds).text(counter);

                if (total == counter) {
                    ele.closest('div').addClass('hidden');
                }

                parent.html(cmds);
            }
        }

        // always
        function onComplete() {
            ele.data('loading', false);
        }

        ele.data('loading', true);

        K.ajax('ajax/comment/comment/view-more', sendData)
            .done(onSuccess)
            .complete(onComplete)
            .error();

    });
});