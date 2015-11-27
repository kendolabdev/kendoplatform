<?php echo $form->open(); ?>
<?php echo $form->asList(); ?>
<div class="form-group">
    <button type="submit" class="btn btn-danger" name="_submit">
        <?php echo $this->helper()->text('photo.create_album'); ?>
    </button>
</div>
<?php echo $form->close(); ?>