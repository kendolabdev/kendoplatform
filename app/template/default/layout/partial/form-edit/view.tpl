<?php echo $form->open(); ?>

<?php echo $form->asList(); ?>

<div class="form-group">
    <?php if(!$form->hasElement('_submit')): ?>
    <button type="submit" class="btn btn-danger" name="_submit"><?php echo $this->
        helper()->text('core.save_changes'); ?>
    </button>
    <?php endif; ?>
</div>
<?php echo $form->close(); ?>