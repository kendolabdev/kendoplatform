<?php if(is_array($membership)): ?>
<div class="options-content">
    <ul class="options-menu">
        <li data-toggle="btn-friend-addlist" data-eid="<?php echo $eid;?>" data-friend="<?php echo $friend->getId();?>">
            <a role="button">
                <?php echo $this->helper()->text('friend.add_to_another_friend_list');?>
            </a></li>
        <li data-toggle="btn-friend-suggest" data-eid="<?php echo $eid;?>" data-friend="<?php echo $friend->getId();?>">
            <a role="button">
                <?php echo $this->helper()->text('friend.suggest_friends');?>
            </a></li>
        <li role="separator" class="divider"></li>
        <li data-toggle="btn-friend-remove" data-eid="<?php echo $eid;?>" data-friend="<?php echo $friend->getId();?>" data-ctx="btn">
            <a role="button">
                <?php echo $this->helper()->text('friend.remove_friend');?>
            </a></li>
    </ul>
</div>
<?php endif; ?>

<?php if($membership == -2): ?>
<div class="options-content">
    <ul class="options-menu">
        <li data-toggle="btn-friend-accept" class=""
            data-eid="<?php echo $eid;?>"
            data-friend="<?php echo $friend->getId();?>">
            <a class="" role="button">
                <i class="ion-person-add"></i>
                <?php echo $this->helper()->text('friend.accept_this_request');?>
            </a>
        </li>
        <li data-toggle="btn-friend-ignore" class=""
            data-remote="ajax/platform/user/friend/friend-options"
            data-eid="<?php echo $eid;?>"
            data-object="<?php echo $friend->getId();?>">

            <a role="button">
                <i class="ion-person-add"></i>
                <?php echo $this->helper()->text('friend.ignore_request');?>
            </a>
        </li>
    </ul>
</div>
<?php endif; ?>