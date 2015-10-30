<div class="user-tlh-ow">
    <div class="user-tlh-iw">
        <div class="user-cover-ow <?php echo $coverPhotoUrl?'has-cover':'';?>">
            <div class="user-cover-iw">
                <img class="user-cover-img" src="<?php echo $coverPhotoUrl; ?>"
                     data-fid="<?php echo $fileId;?>"
                     style="width:100%; position: absolute;top:<?php echo $coverPositionTop; ?>"/>
            </div>
        </div>
        <!--action groups-->
        <div class="profile-header-overlay no-editing"></div>
        <!--/action groups-->
        <div class="user-profile-ow">
            <div class="user-profile-iw">
                <img class="user-profile-img" src="<?php echo $profile->getPhoto('avatar_xl');?>"/>
            </div>
        </div>
        <?php if(!$isOwner): ?>
        <div class="absolute bottom right">
            <div class="text-right btn-group">
                <?php echo $profile->btnMembership(); ?>
                <?php echo $this->helper()->btnMessage($profile); ?>
                <div class="btn-group">
                    <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="ion-android-more-horizontal"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <?php echo $this->helper()->btnBlock($profile,null,'menu'); ?>
                            <?php echo $this->helper()->btnFollow($profile, null,'menu'); ?>
                            <?php echo $this->helper()->btnReport($profile, null,'menu'); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="absolute bottom right">
            <div class="btn-group no-editing">
                <a class="btn btn-sm btn-default" href="<?php echo $this->helper()->url('edit_profile');?>">
                    <b class="ion-edit"></b>
                    <?php echo $this->helper()->text('user.edit_profile');?></a>
                <?php echo $this->helper()->btnUpdateCover($profile);?>
            </div>
            <?php echo $this->helper()->btnUpdateCoverEditing($profile);?>
        </div>

        <?php endif; ?>

        <div class="absolute top right">
            <div class="btn-group">
                <?php echo $this->helper()->btnLoginAs($profile); ?>
            </div>
        </div>

        <?php if($canEditProfile): ?>
        <div class="absolute bottom left">
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-link dropdown-toggle ion-camera" data-toggle="dropdown"
                        aria-expanded="false">
                    <!--<span class="ion-camera"></span>-->
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a data-toggle="tl-avatar-upload" data-target="#inputFileAvatar">
                            <?php echo $this->helper()->text('core.upload_photo'); ?>
                        </a>
                    </li>
                    <li data-toggle="tl-avatar-reposition" class="hidden">
                        <a>
                            <?php echo $this->helper()->text('core.reposition'); ?>
                        </a>
                    </li>
                    <li data-toggle="tl-avatar-save" class="hidden"
                        data-object='<?php echo json_encode($dataSubject);?>'>
                        <a>
                            <?php echo $this->helper()->text('core.save_avatar'); ?>
                        </a>
                    </li>
                    <li data-toggle="tl-avatar-cancel" class="hidden">
                        <a>
                            <?php echo $this->helper()->text('core.cancel'); ?>
                        </a>
                    </li>
                </ul>
                <input type="file" id="inputFileAvatar" accept="image/*" data-toggle="" class="hidden"/>
            </div>
        </div>
        <?php endif; ?>

        <a class="profile-header-title" href="<?php echo $profile->toHref();?>"><?php echo $profile->getTitle(); ?></a>
    </div>
</div>
<div class="user-tlh-nav-ow">
    <div class="user-tlh-nav-iw clearfix">
        <?php echo \App::nav()->render('dropdown','profile', null,[], 1, $profileTabMenuOptions);?>
    </div>
</div>