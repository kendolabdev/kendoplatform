<?php echo $form->open(); ?>

<div class="page-heading">
    <h1 class="page-title"><?php echo $form->getTitle();?></h1>
    <div class="page-note">
        <?php echo $form->getNote(); ?>
    </div>
</div>

<?php echo $form->asList(); ?>

<div class="form-group">
    <?php if(!$form->hasElement('_submit')): ?>
    <button type="submit" class="btn btn-primary btn-sm" name="_submit"><?php echo $this->
        helper()->text('core.delete'); ?>
    </button>
    <?php endif; ?>
</div>
<?php echo $form->close(); ?>