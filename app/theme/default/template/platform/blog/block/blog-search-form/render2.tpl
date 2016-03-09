<div class="page-heading">
    <h1 class="page-title"><?php echo $form->getTitle();?></h1>
    <div class="page-note">
        <?php echo $form->getNote(); ?>
    </div>
</div>


<?php echo $form->open(); ?>
<?php echo $form->asList(); ?>
<?php echo $form->close(); ?>