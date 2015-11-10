<div class="small-login-form">
    <div class="help-block">
        <?php echo $note; ?>
    </div>
    <?php if($showService): ?>
    <div class="form-group text-center hidden">
        <?php foreach($services as $service):?>
        <a href="<?php echo $service->getConnectUrl([]);?>"
           class="btn-social btn-social-sm <?php echo $service->getId()?>" title="<?php echo $service->getTitle();?>">
            <i class="<?php echo $service->getIonIconClass();?>"></i>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php echo $form->open();?>
    <?php echo $form->asList();?>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-danger btn-block"><?php echo $this->
            helper()->text('user.login');?>
        </button>
    </div>

    <div class="form-group">
        <div class="text-center">
            <?php echo $this->helper()->textLink('core.forgot_password',array(),'forgot_password'); ?>
        </div>
        <div class="text-center">
            <?php echo $this->helper()->textLink('core.create_new_account',array(),'register'); ?>
        </div>
    </div>
</div>