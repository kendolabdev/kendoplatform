<div class="small-login-form">
    <?php if($showService): ?>
    <div class="text-center">
        Connect With
    </div>
    <div class="form-group text-center">
        <?php foreach($services as $service):?>
        <a href="<?php echo $service->getConnectUrl([]);?>"
           class="btn-social <?php echo $service->getId()?>" title="<?php echo $service->getTitle();?>">
            <i class="<?php echo $service->getIonIconClass();?>"></i>
        </a>
        <?php endforeach; ?>
    </div>
    <hr/>
    <?php endif; ?>
    <?php echo $form->open();?>
    <?php echo $form->asList();?>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"><?php echo $this->
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