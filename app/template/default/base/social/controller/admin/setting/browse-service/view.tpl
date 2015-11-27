<div class="page-heading">
    <div class="page-title">
        Manage Social Providers
    </div>
    <div class="page-note">
        Control how Facebook, Twitter, ... integrate to your network!
    </div>
</div>

<?php foreach($paging->items() as $item): ?>
<div>
    <a title="<?php echo $this->helper()->text('core.edit_settings');?>"
       href="<?php echo $this->helper()->url('admin',array('stuff'=>'social/setting/edit','name'=> $item->getSettingForm())); ?>">
        <h5><?php echo $item->getName();?></h5></a>

    <p class="help-block">
        <?php echo $item->getNote('core.social_service_note_');?>
    </p>
</div>
<hr/>
<?php endforeach; ?>