<div class="page-heading">
    <h1 class="page-title"><?php echo $form->getTitle(); ?></h1>

    <div class="page-note"><?php echo $form->getNote(); ?></div>
</div>
<?php echo $form->open(); ?>
<?php echo $form->asList(); ?>
<div>
    <button type="submit" role="button" class="btn btn-primary">
        <?php echo $this->
        helper()->text('core.continue');?>
    </button>
</div>

<?php echo $form->close(); ?>