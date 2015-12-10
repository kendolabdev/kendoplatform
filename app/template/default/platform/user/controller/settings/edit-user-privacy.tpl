<?php echo $form->open(); ?>
<h5 class="lead">
    <?php echo $form->getTitle(); ?>
</h5>
<p>
    <?php echo $form->getNote(); ?>
</p>
<?php echo $form->asList(); ?>

<div>
    <button type="submit" role="button" class="btn btn-primary btn-sm"><?php echo $this->helper()->text('core.save_changes');?></button>
</div>

<?php echo $form->close(); ?>