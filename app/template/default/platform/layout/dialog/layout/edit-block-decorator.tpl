<form method="post" async data-action="admin/layout/ajax/editor/edit-block-decorator">
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
                <?php echo $this->helper()->text('core.cancel'); ?>
            </button>
            <button type="submit" class="btn btn-primary">
                <?php echo $this->helper()->text('core.continue'); ?>
            </button>
        </div>
    </div>
</form>