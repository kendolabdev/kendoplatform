<?php echo $form->open(); ?>
<div class="page-heading">
    <h1 class="page-title"><?php echo $this->helper()->text('user.login');?></h1>

    <?php if($enableSocialAuth): ?>
    <div class="page-note">
        <?php foreach($social as $item): ?>
        <a role="button" class="btn btn-social <?php echo $item->getId(); ?> " data-toggle="1" href="<?php echo $this->helper()->url('connect',['service'=>$item->getId()]);?>">
            <i class="<?php echo $item->getIonIconClass();?>"></i>
        </a>
        <?php endforeach;?>
    </div>
    <?php endif; ?>
</div>
<?php if(null !=$form->getNote()): ?>
<div class="page-note">
    <?php echo $form->getNote(); ?>
</div>
<?php endif; ?>
<?php echo $form->asList(); ?>
<button class="btn btn-primary" type="submit"><?php echo $this->helper()->text('user.login');?></button>
<?php echo $form->close(); ?>