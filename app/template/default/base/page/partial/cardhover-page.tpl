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
                [other information can put there]
            </div>
        </div>
        <div class="cardhover-profile-photo">
            <a href="<?php echo $profile->toHref(); ?>">
                <img src="<?php echo $profile->getPhoto('avatar_lg');?>"/>
            </a>
        </div>
    </div>
    <div class="cardhover-footer">
        <!-- friend button-->
        <?php if($canFriend): ?>
        <div class="btn-group btn-friend-ow">
            <?php echo $friend->btnMembership();?>
        </div>
        <?php endif; ?>
        <!--/friend button-->

        <!--folow button-->
        <?php if($canFollow): ?>
        <div class="btn-group btn-follow-ow">
            <?php echo $this->helper()->btnFollow($profile); ?>
        </div>
        <?php endif; ?>
        <!--/follow button-->

        <!-- message button-->
        <?php if($canMessage): ?>
        <div class="btn-group">
            <a class="btn btn-sm btn-default"
               data-remote="ajax/message/message/compose"
               data-object='<?php echo json_encode($dataSubject);?>'
               data-toggle="modal">
                <span class="ion-email-unread"></span>
                        <span class="btn-txt">
                            <?php echo $this->helper()->text('core.message'); ?>
                        </span>
            </a>
        </div>
        <?php endif; ?>
        <!--/message button-->
    </div>
</div>