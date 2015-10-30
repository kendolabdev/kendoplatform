<?php echo $form->open(); ?>
<div class="hyves-content">
    <div class="hyves-header">
        <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="hyves-title"><?php echo $this->helper()->text('user.login');?></h4>
    </div>
    <div class="hyves-body">
        <?php echo $form->asList(); ?>
    </div>
    <div class="hyves-footer">
        <button type="submit" class="btn btn-primary">
            <?php echo $this->helper()->text('user.login');?>
        </button>
    </div>
</div>
<?php echo $form->close();?>