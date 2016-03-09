<?php echo $form->open(); ?>

<div class="page-heading">
    <h1 class="page-title"><?php echo $form->getTitle();?></h1>
    <?php if(null !=$form->getNote()): ?>
    <div class="page-note">
        <p>
            <?php echo $form->getNote(); ?>
        </p>
        <p>In order to control each notification type visit <a
                href="<?php echo $this->helper()->url('admin',['any'=>'notification/setting/type']);?>">
            <b>Notification
                Type</b></p>
    </a>
    </div>
    <?php endif; ?>
</div>

<?php echo $form->asList(); ?>

<div class="form-group">
    <?php if(!$form->hasElement('_submit')): ?>
    <button type="submit" class="btn btn-danger" name="_submit"><?php echo $this->
        helper()->text('core.save_changes'); ?>
    </button>
    <?php endif; ?>
</div>
<?php echo $form->close(); ?>