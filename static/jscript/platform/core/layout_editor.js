define(['jquery', 'jqueryui'], function ()
{
    var editor = '#layouteditor',
        debug = true,
        blockKey = {
            prefix: 'b',
            length: 15
        },
        sectionKey = {
            prefix: 'b',
            length: 12
        },
        checkContainerLoop = function ()
        {
            //$('.location.leaf', '.location.leaf').remove();
        },
        enableDragDrop = function ()
        {
            debug && console.log("enabled drag & drop");

            $(".available_containers").sortable({
                connectWith: "#layouteditor .location.node",
                handle: '.dragable-element-header',
                cancel: '.element-placeholder',
                cursor: 'move',
                opacity: 0.6,
                dropOnEmpty: true,
                remove: function (event, ui)
                {
                    var anchor = ui.item.data('anchor');
                    ui.item.clone().insertAfter(anchor);
                    enableDragDrop();
                    checkContainerLoop();
                    saveLayout();
                }
            });

            $(".available_blocks").sortable({
                connectWith: "#layouteditor .location",
                handle: '.dragable-element-header',
                cancel: '.element-placeholder',
                cursor: 'move',
                opacity: 0.6,
                dropOnEmpty: true,
                remove: function (event, ui)
                {
                    var anchor = ui.item.data('anchor');
                    ui.item.clone().insertAfter(anchor);
                    saveLayout();
                },
            });

            $("#layouteditor .location").sortable({
                connectWith: "#layouteditor .location",
                cursor: 'move',
                //handle: '.dragable-element', // cancel this mode because it's failed .
                //cancel: '.dragable-element-placeholder'
                dropOnEmpty: true,
                remove: function ()
                {
                    checkContainerLoop();
                    saveLayout();
                }
            }).disableSelection();

            $('#layouteditor').sortable({
                connectWith: $('#layouteditor'),
                handle: '.section-header',
                cancel: '.section-placeholder',
                cursor: 'move',
                dropOnEmpty: true
                //dropOnEmpty: false
            }).disableSelection();
        },
        getLayoutConfigData = function ()
        {
            return $(editor).data('object');
        };


    $.fn.layoutEditorEnabledDragDrop = function ()
    {
        enableDragDrop();
    }

    function layoutAddSection(ele)
    {
        var sendData = $.extend({}, {tpl: ele.data('tpl')});

        $kd.ajax('admin/layout/ajax/editor/add-section', sendData)
            .done(function (response)
            {
                $(response.html).prependTo('#layouteditor');
                enableDragDrop();
            });
    }

    function layoutChangeSection(ele)
    {

        var main = $('.section-main','#layouteditor'),
            sendData = $.extend({}, {tpl: ele.data('tpl')});

        if(main.length){
            sendData.sectionId =  main.eid();
        }

        $kd.ajax('admin/layout/ajax/editor/change-section', sendData)
            .done(function (response)
            {
                if(main.length)
                {
                    main.replaceWith(response.html);
                }
                else{
                    $('#layouteditor').append(response.html);
                }
                enableDragDrop();
            });
    }


    function collectLeafBlockData(block, order)
    {
        var locations = $('>.dragable-element-body >.row > .location.leaf', block);
        return {
            block_id: block.eid(blockKey.prefix, blockKey.length),
            block_order: order,
            parent_block_id: block.closest('.location.node').eid(),
            support_block_id: block.data('support'),
            section: block.closest('.section').data('section'),
            node_id: block.closest('.location.node').data('location'),
            leaf_id: block.closest('.location.leaf').data('location'),
            settings: block.data('settings'),
            blocks: collectLeafBlockListData(locations),
        }
    }

    /**
     *
     * @param locations
     */
    function collectLeafBlockListData(locations)
    {
        var blocks,
            block,
            blockDatas = {},
            key,
            n = 0,
            i = 0;

        for (; n < locations.length; ++n)
        {
            blocks = $('>.dragable-element', locations[n])
            for (i = 0; i < blocks.length; ++i)
            {
                block = $(blocks[i]);
                key = block.eid(blockKey.prefix, blockKey.length);
                blockDatas[key] = collectLeafBlockData(block, i);
            }
        }
        return blockDatas;
    }

    /**
     *
     * @param block
     */
    function collectBlockData(block, order)
    {
        var locations = $('>.dragable-element-body >.row > .location.leaf', block);

        return {
            block_id: block.eid(blockKey.prefix, blockKey.length),
            support_block_id: block.data('support'),
            parent_block_id: '',
            section: block.closest('.section').data('section'),
            node_id: block.closest('.location.node').data('location'),
            leaf_id: '',
            block_order: order,
            render: block.data('render'),
            settings: block.data('settings'),
            blocks: collectLeafBlockListData(locations),
        };
    }

    /**
     *
     * @param locations
     */
    function collectBlockListData(locations)
    {
        var blocks,
            block,
            blockDatas = {},
            key,
            n = 0,
            i = 0;

        for (; n < locations.length; ++n)
        {
            blocks = $('>.dragable-element', locations[n]);
            for (i = 0; i < blocks.length; ++i)
            {
                block = $(blocks[i]);
                key = block.eid(blockKey.prefix, blockKey.length);
                blockDatas[key] = collectBlockData(block, i);
            }
        }
        return blockDatas;
    }

    /**
     *
     */
    function collectRemainBlockIdList(section)
    {
        var blocks = $('.dragable-element', section), i = 0,
            blockIdList = [];

        for (; i < blocks.length; ++i)
        {
            blockIdList.push($(blocks[i]).eid(blockKey.prefix, blockKey.length));
        }

        return blockIdList;
    }

    /**
     *
     */
    function collectSectionData(section, order)
    {
        var locations = $('.location.node', section);

        return {
            section_id: section.eid(sectionKey.prefix, sectionKey.length),
            section_order: order,
            section_template: section.data('render'),
            blocks: collectBlockListData(locations),
            remainBlockIdList: collectRemainBlockIdList(section)
        };
    }

    /**
     * find of handersee.
     *
     * @returns {{}}
     */
    function collectLayoutData()
    {
        checkContainerLoop();
        var sections = $('.section', editor),
            i = 0,
            sectionsData = {},
            sectionId,
            section,
            sendData = $(editor).data('object');

        for (; i < sections.length; ++i)
        {
            section = $(sections[i]);
            sectionId = section.eid(sectionKey.prefix, sectionKey.length);
            sectionsData[sectionId] = collectSectionData(section, i);
        }

        sendData.sections = sectionsData;

        return sendData;
    }

    function saveLayout()
    {
        var sendData = collectLayoutData();

        console.log(sendData);

        $kd.ajax('admin/layout/ajax/editor/update-layout', sendData)
            .done(function (response)
            {
                console.log(response);
            });
    }

    $(document).on('click', '[data-toggle="layout-edit-content"]', function ()
    {
        // edit block content
        var ele = $(this),
            url = 'admin/layout/ajax/editor/select-content-script',
            sendData = $.extend({layoutType: ele.data('layout')}, getLayoutConfigData());
        $kd.modal(url, sendData);
    });
    $(document).on('click', '[data-toggle="layout-delete-content"]', function ()
    {
        // edit block content
        var ele = $(this),
            url = 'admin/layout/ajax/editor/delete-content-setting',
            sendData = $.extend({layoutType: ele.data('layout')}, getLayoutConfigData());
        $kd.ajax(url, sendData)
            .done(function (result)
            {
                Toast.success(result.message);
            });
    });

    $(document).on('click', '[data-toggle="layout-change-section"]', function ()
    {
        layoutChangeSection($(this));
    });

    $(document).on('click', '[data-toggle="layout-add-section"]', function ()
    {
        layoutAddSection($(this));
    });

    $(document).on('click', '[data-toggle="layout-clear"]', function ()
    {
        $(editor).html('');
    });

    $(document).on('click', '[data-toggle="layout-block-edit"]', function ()
    {
        // edit block content
        var ele = $(this),
            url = 'admin/layout/ajax/editor/select-block-script',
            sendData = $.extend({}, getLayoutConfigData(), ele.data('object'));

        sendData.blockId = $(sendData.eid).closest('.dragable-element').eid();

        $kd.modal(url, sendData);

    });

    $(document).on('click', '[data-toggle="layout-decorator-edit"]', function ()
    {
        // edit block content
        var ele = $(this),
            url = 'admin/layout/ajax/editor/edit-block-decorator',
            sendData = $.extend({}, getLayoutConfigData(), ele.data('object'));

        sendData.blockId = $(sendData.eid).closest('.dragable-element').eid();

        $kd.modal(url, sendData);

    });

    $(document).on('click', '[data-toggle="layout-block-remove"]', function ()
    {
        var ele = $(this),
            data = ele.data('object');

        $(data.eid)
            .closest('.dragable-element')
            .remove();

        saveLayout();
    });
    $(document).on('click', '[data-toggle="layout-save"]', function ()
    {
        saveLayout();
    });
    $(document).on('click', '[data-toggle="layout-block-update"]', function ()
    {
        var ele = $(this),
            form = ele.closest('form'),
            sendData = form.serializeJSON(),
            block = $(sendData.eid).closest('.dragable-element');

        $kd.ajax('admin/layout/ajax/editor/update-block-settings', sendData)
            .done(function (response)
            {
                if (response.code == 200)
                {
                    block.data('settings', sendData);
                }
                if (response.script)
                {
                    eval(response.script);
                }
                if (response.html)
                {

                }
                block.data('settings', sendData);
            });
    });

    $(document).on('click', '[data-toggle="layout-section-edit"]', function ()
    {
    });
    $(document).on('click', '[data-toggle="layout-section-remove"]', function ()
    {
        var ele = $(this),
            eid = ele.data('eid'),
            section = $(eid).closest('.section'),
            sectionId = section.eid();

        section.animate({opacity: 0}, 200, function ()
        {
            section.remove()
        });

        $kd.ajax('admin/layout/ajax/editor/delete-section', {sectionId: sectionId})
            .done(function (result)
            {
                Toast.success(result.message);
            });
    });
});