<?php echo $form->open(); ?>
<div class="hyves-dialog">
    <div class="hyves-content">
        <div class="hyves-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="hyves-title" id="myModalLabel"><?php echo $this->helper()->text('core_layout_editor.edit_content_settings'); ?></h4>
        </div>
        <div class="hyves-body">
            <?php echo $form->asList(); ?>
        </div>
        <div class="hyves-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->helper()->text('core.close');?></button>
            <button type="button" class="btn btn-primary" onclick="LayoutEditor.elementUpdateSetting(this,'<?php echo $eid;?>')"><?php echo $this->helper()->text('core.save_change'); ?></button>
        </div>
    </div>
</div>
<?php echo $form->close();?>