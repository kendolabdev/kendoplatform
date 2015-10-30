<?php if($membership == ''): ?>
<button data-toggle="btn-friend-request" class="btn btn-default btn-default btn-sm btn-membership"
        title="<?php echo $this->helper()->text('friend.send_friend_request');?>"
        data-friend="<?php echo $friend->getId();?>">
    <span class="ion-person-add"></span>
        <span class="btn-txt">
            <?php echo $this->helper()->text('friend.add_friend');?>
        </span>
</button>
<?php endif; ?>

<?php if($membership == -1): ?>
<button data-toggle="btn-friend-cancel" class="btn btn-default btn-default btn-sm btn-membership"
        title="<?php echo $this->helper()->text('friend.cancel_friend_request');?>"
        data-friend="<?php echo $friend->getId();?>">
    <span class="ion-person-add"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('friend.cancel_request');?>
    </span>
</button>
<?php endif; ?>


<?php if($membership == -2): ?>
<button class="btn btn-danger btn-sm btn-membership"
        data-toggle="options"
        data-remote="ajax/user/friend/membership-options"
        data-object='<?php echo _escape($friend->toTokenArray());?>'>
    <span class="ion-person-add"></span>
    <span class="btn-txt"><?php echo $this->helper()->text('friend.request_friend');?></span>
    <span class="caret"></span>
</button>
<?php endif; ?>

<?php if(is_array($membership)): ?>
<button class="btn btn-default btn-sm btn-membership"
        data-toggle="options"
        data-remote="ajax/user/friend/membership-options"
        data-object='<?php echo _escape($friend->toTokenArray());?>'>
    <span class="ion-star"></span>
    <span class="btn-txt"><?php echo $this->helper()->text('friend.friend');?></span>
    <span class="caret"></span>
</button>
<?php endif; ?>

