<div class="page-heading">
    <h1 class="page-title">
        <?php echo $this->helper()->text('core_nav_admin.admin_manage_captcha_settings'); ?>
    </h1>

    <div class="page-note">
    </div>
</div>

<?php foreach($paging->items() as $item): ?>
<div>
    <a href="<?php echo $this->helper()->url('admin', array('any'=>'captcha/manage/edit','name'=> $item->getSettingForm()));?>">
        <h5><?php echo $item->getName(); ?></h5></a>

    <p><?php echo $item->getNote(); ?></p>
    <hr/>
</div>
<?php endforeach; ?>