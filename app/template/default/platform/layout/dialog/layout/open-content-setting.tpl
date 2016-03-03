<form method="post" async data-action="admin/layout/ajax/editor/open-content-setting">
    <input type="hidden" name="pageName" value="<?php echo $pageName; ?>"/>
    <input type="hidden" name="templateId" value="<?php echo $templateId; ?>"/>
    <input type="hidden" name="layoutType" value="<?php echo $layoutType; ?>"/>
    <input type="hidden" name="screenSize" value="<?php echo $screenSize; ?>"/>
    <input type="hidden" name="edit_step" value="save_setting" />

    <div class="hyves-content">
        <div class="hyves-header">
            <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="hyves-title">Content Settings</h4>
        </div>
        <div class="hyves-body">
            <?php echo $form->asList();?>
        </div>
        <div class="hyves-footer">
            <button type="button" class="btn btn-default" data-toggle="btn-hyves-close">
                <?php echo $this->helper()->text('core.cancel'); ?>
            </button>
            <button type="submit" class="btn btn-primary">
                <?php echo $this->helper()->text('core.save_changes'); ?>
            </button>
        </div>
    </div>
</form>