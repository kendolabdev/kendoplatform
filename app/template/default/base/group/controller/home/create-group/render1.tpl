<?php echo \App::nav()->render('group_main', 1, 'tab', array('level0'=>'nav nav-tabs')); ?>

<?php echo $form->open(); ?>
<?php echo $form->asList(); ?>
<?php echo $form->close(); ?>