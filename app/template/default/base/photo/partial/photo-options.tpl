<div class="options-content">
    <ul class="options-menu">
        <li role="presentation" data-toggle="photo-make-profile-photo" data-object='<?php echo _escape($item->toTokenArray());?>'>
            <a role="button"><?php echo $this->helper()->text('photo.make_profile_photo');?></a>
        </li>
        <li role="presentation">
            <a role="button" href="<?php echo $viewer->toHref(['editcover'=>1,'fileId'=>$item->getPhotoFileId()]);?>"><?php echo $this->helper()->text('photo.make_profile_cover');?></a>
        </li>
        <li role="presentation" data-toggle="photo-make-album-cover" data-object='<?php echo _escape($item->toTokenArray());?>'>
            <a role="button"><?php echo $this->helper()->text('photo.make_album_cover');?></a>
        </li>
        <li class="divider"></li>
        <li>
            <a role="button">
                <i class="ion-edit"></i>
                <?php echo $this->helper()->text('photo.edit_photo'); ?>
            </a>
        </li>
        <li role="presentation"
            data-toggle="photo-delete"
            data-eid="<?php echo $eid;?>"
            data-object='<?php echo _escape($item->toTokenArray());?>'>
            <a role="button">
                <i class="ion-android-delete"></i>
                <?php echo $this->helper()->text('photo.delete_photo'); ?>
            </a>
        </li>
        <li>
            <a role="button">
                <i class="ion-android-download"></i>
                <?php echo $this->helper()->text('photo.download_photo'); ?>
            </a>
        </li>
        <li class="divider"></li>
        <li role="presentation" data-toggle="btn-report" data-object='<?php echo _escape($item->toTokenArray());?>'>
            <a role="button">
                <i class="ion-ios-paper"></i>
                <?php echo $this->helper()->text('core.report_about_this');?>
            </a>
        </li>
    </ul>
</div>