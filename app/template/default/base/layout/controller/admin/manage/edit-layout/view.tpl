<div class="page-heading">
    <h1 class="page-title">Layout Editor</h1>
    <div class="page-note row">
        <div class="col-md-9">
            <button class="btn btn-sm btn-default" onclick="window.history.back()">
                Go back
            </button>
            <div class="btn-group">
                <button class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo $this->helper()->text('core_layout_editor.add_section');?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach($supportSections as $item): ?>
                    <li>
                        <a role="button" data-toggle="layout-add-section"
                           data-tpl="<?php echo $item->getId();?>"><?php echo $item->getTitle();?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <button class="btn btn-sm btn-danger" data-toggle="layout-clear">
                <?php echo $this->helper()->text('core_layout_editor.clear_layout');?>
            </button>
            <button class="btn btn-sm btn-primary" data-toggle="layout-save">
                <?php echo $this->helper()->text('core.save_change');?>
            </button>

            <div class="btn-group">
                <button class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo $this->helper()->text('core_layout_editor.configure');?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li role="presentation">
                        <a role="button" data-toggle="layout-edit-content" data-layout="header">
                            <?php echo $this->helper()->text('core.edit_header_layout');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="button" data-toggle="layout-edit-content" data-layout="footer">
                            <?php echo $this->helper()->text('core.edit_footer_layout');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="button" data-toggle="layout-edit-content" data-layout="content">
                            <?php echo $this->helper()->text('core.edit_content_layout');?>
                        </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li role="presentation">
                        <a role="button" data-toggle="layout-delete-content" data-layout="header">
                            <?php echo $this->helper()->text('core.reset_header_layout');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="button" data-toggle="layout-delete-content" data-layout="footer">
                            <?php echo $this->helper()->text('core.reset_footer_layout');?>
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="button" data-toggle="layout-delete-content" data-layout="content">
                            <?php echo $this->helper()->text('core.reset_content_layout');?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-3 text-right">
            <form class="form-inline" onsubmit="return false;" style="margin:0;padding:0;">
                <input id="findblock" type="text" class="form-control input-sm" placeholder="Find block ..."/>
                <input type="submit" class="sr-only"/>
            </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Available Container
            </div>
            <div class="panel-body" style="height:137px;overflow-y:scroll">
                <div class="available_containers">
                    <?php foreach($supportContainers as $item): ?>
                    <div class="hidden" id="anchor_div_<?php echo $item->getId();?>"></div>
                    <?php echo $item->renderForEdit(); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <!-- List all alvailable block here -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Available Contents
            </div>
            <div class="panel-body" style="height:137px;overflow-y:scroll">
                <div class="available_blocks">
                    <?php foreach($supportBlocks as $item): ?>
                    <div class="hidden" id="anchor_div_<?php echo $item->getId();?>"></div>
                    <?php echo $item->renderForEdit(); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<p>
    Start by add new section
</p>

<div class="col-md-12" id="layouteditor" ride="layoutEditorEnabledDragDrop"
     data-object='<?php echo _escape($layoutAttrs);?>'>
    <?php echo $layoutEditHtml; ?>
</div>