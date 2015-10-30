<div class="user-cardhover">
    <div class="cardhover-body">
        <div class="cardhover-cover"
             style="background-image: url(<?php echo $coverPhotoUrl; ?>); background-position: 0 <?php echo $coverPositionTop; ?>">
            <div>
            </div>
            <div class="cardhover-headline">
                <a class="cardhover-title" href="href="<?php echo $profile->toHref(); ?>">
                <?php echo $profile->getTitle(); ?>
                </a>
            </div>
        </div>
        <div class="cardhover-main">
            <div class="cardhover-info">
                <div><i class="ion-person-stalker"/> <?php echo $this->helper()->btnFriendCount($profile);?></div>
                [other information can put there]
            </div>
        </div>
        <div class="cardhover-profile-photo">
            <a href="<?php echo $profile->toHref(); ?>">
                <img src="<?php echo $profile->getPhoto('avatar_xl');?>"/>
            </a>
        </div>
    </div>
    <div class="cardhover-footer">

        <!-- friend button-->
        <?php echo $profile->btnMembership();?>
        <!--/friend button-->

        <!--folow button-->
        <?php echo $this->helper()->btnFollow($profile); ?>
        <!--/follow button-->

        <!-- message button-->
        <?php echo $this->helper()->btnMessage($profile); ?>
        <!--/message button-->

        <!-- message button-->
        <?php echo $this->helper()->btnLoginAs($profile); ?>
        <!--/message button-->
    </div>
</div>