<div class="user-tlh-ow">
    <div class="user-tlh-iw">
        <div class="user-cover-ow <?php echo $coverPhotoUrl?'has-cover':'';?>">
            <div class="user-cover-iw bg-img" style="background-image: url(<?php echo $coverPhotoUrl; ?>)">
            </div>
        </div>

        <div class="profile-header-overlay"></div>

        <div class="absolute top left">
            <div class="btn-group">
                <?php echo $this->helper()->btnLoginAs($profile); ?>
            </div>
        </div>

        <!--action groups-->
        <div class="absolute top right">
            <?php if($isOwner):?>
            <div class="btn-group">
                <a class="btn btn-sm btn-default" href="<?php echo $this->helper()->url('edit_profile');?>">
                    <b class="ion-edit"></b>
                    <?php echo $this->helper()->text('user.edit_profile');?></a>
                <?php echo $this->helper()->btnUpdateCover($profile);?>
            </div>
            <?php endif;?>
        </div>
        <!-- /can change profile picture-->

        <?php if(!$isOwner): ?>
        <div class="absolute top right">
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
        <?php endif; ?>
        <!--/action groups-->
        <div class="user-profile-ow">
            <div class="user-profile-iw">
                <img class="user-profile-img" src="<?php echo $profile->getPhoto('avatar_xl');?>"/>
            </div>
        </div>
        <a class="profile-header-title" href="<?php echo $profile->toHref();?>"><?php echo $profile->getTitle(); ?></a>
    </div>
</div>
<div class="user-tlh-nav-ow">
    <div class="user-tlh-nav-iw clearfix">
        <?php echo \App::navigation()->render('dropdown','profile', null,[], 1, $profileTabMenuOptions);?>
    </div>
</div>