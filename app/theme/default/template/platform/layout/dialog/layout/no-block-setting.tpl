<form method="post" async data-action="admin/layout/ajax/editor/update-block-setting">
    <input type="hidden" name="supportBlockId" value="<?php echo $supportBlockId; ?>"/>
    <input type="hidden" name="blockId" value="<?php echo $blockId; ?>"/>
    <input type="hidden" name="eid" value="<?php echo $eid; ?>"/>
    <input type="hidden" name="pageName" value="<?php echo $pageName; ?>"/>
    <input type="hidden" name="templateId" value="<?php echo $templateId; ?>"/>
    <input type="hidden" name="screenSize" value="<?php echo $screenSize; ?>"/>
    <input type="hidden" name="step" value="save_setting"/>

    <div class="hyves-content">
        <div class="hyves-header">
            <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="hyves-title"><?php echo $form->getTitle();?></h4>
        </div>
        <div class="hyves-body">
            <?php echo $form->asList();?>
        </div>
        <div class="hyves-footer">
            <button type="button" class="btn btn-default" data-toggle="btn-hyves-close">
                <?php echo $this->helper()->text('core.close'); ?>
            </button>
        </div>
    </div>
</form>