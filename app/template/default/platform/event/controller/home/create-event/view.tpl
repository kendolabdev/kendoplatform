<?php echo $form->open(); ?>
<?php echo $form->asList(); ?>
<div class="form-group">
    <?php if(!$form->hasElement('_submit')): ?>
    <button type="submit" class="btn btn-primary btn-sm" name="_submit"><?php echo $this->
        helper()->text('core.continue'); ?>
    </button>
    <?php endif; ?>
</div>
<?php echo $form->close(); ?>