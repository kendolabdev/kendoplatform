<div class="page-heading">
    <h1 class="page-title">
        <?php echo $this->helper()->text('core_nav_admin.admin_manage_mail_transport'); ?>
    </h1>

    <div class="page-note">
    </div>
</div>
<?php foreach($paging->items() as $item): ?>
<div>
    <a href="<?php echo $this->helper()->url('admin', array('any'=>'mail/transport/edit','name'=> $item->getSettingForm(),'t'=>'admin_manage_mail'));?>">
        <h5><?php echo $item->getName(); ?></h5></a>

    <p><?php echo $item->getNote(); ?></p>
    <hr/>
</div>
<?php endforeach; ?>