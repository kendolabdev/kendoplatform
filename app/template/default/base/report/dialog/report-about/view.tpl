<form data-action="ajax/report/report/add" async>
    <div class="hyves-content">
        <div class="hyves-header">
            <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="hyves-title"><?php echo $this->helper()->text('core.report');?></h4>
        </div>
        <div class="hyves-body">
            <?php echo $form->asList(); ?>
        </div>
        <div class="hyves-footer">
            <button type="button" class="btn btn-default" data-toggle="btn-hyves-close">
                <?php echo $this->
                helper()->text('core.cancel'); ?>
            </button>
            <button type="submit" class="btn btn-primary" data-toggle="btn-report-submit">
                <?php echo $this->
                helper()->text('core.report'); ?>
            </button>
        </div>
    </div>
</form>