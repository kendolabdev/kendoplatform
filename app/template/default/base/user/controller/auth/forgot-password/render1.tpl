<?php echo $form->open(); ?>
<?php echo $form->asList(); ?>
<div>
    <button class="btn btn-danger btn-sm">
        <?php echo $this->helper()->text('core.reset_password');?>
    </button>
</div>
<?php echo $form->close(); ?>