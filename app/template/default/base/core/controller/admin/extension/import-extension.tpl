<div class="page-heading">
    <h1 class="page-title">Import Packages</h1>
</div>

<?php echo $form->open(); ?>

<?php echo $form->asList();?>

<div class="form-group">
    <button type="submit" class="btn btn-danger" name="_submit"><?php echo $this->
        helper()->text('core.upload'); ?>
    </button>
</div>

<?php echo $form->close(); ?>