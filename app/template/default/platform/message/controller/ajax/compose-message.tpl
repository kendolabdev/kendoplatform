<?php echo $form->open(); ?>
<div class="hyves-content">
    <div class="hyves-header">
        <button type="button" class="close" data-toggle="btn-hyves-close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="hyves-title"><?php echo $form->getTitle();?></h4>
    </div>
    <div class="hyves-body">
        <?php if($form->getNote() != ''): ?>
        <p class="help-block">
            <?php echo $form->getNote(); ?>
        </p>
        <?php endif; ?>
        <?php echo $form->asList(); ?>
    </div>
    <div class="hyves-footer">
        <button type="submit" class="btn btn-primary btn-sm" name="_submit"><?php echo $this->
            helper()->text('core.save_changes'); ?>
        </button>
    </div>
</div>
<?php echo $form->close(); ?>