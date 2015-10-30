<?php $objectTxt= json_encode(array('type'=>$item->getType(), 'id'=>$item->getId())); ?>
<?php if($membership == 0): ?>
<button data-toggle="btn-event-join" class="btn btn-default btn-default btn-sm"
        title="<?php echo $this->helper()->text('friend.join_event');?>"
        data-object='<?php echo $objectTxt;?>'>
    <span class="ion-person-add"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('event.join_event');?>
    </span>
</button>
<?php elseif(in_array($membership, array(-1,-2))): ?>
<button data-toggle="btn-event-cancel" class="btn btn-default btn-default btn-sm"
        title="<?php echo $this->helper()->text('friend.cancel_friend_request');?>"
        data-object='<?php echo $objectTxt;?>'>
    <span class="ion-person-add"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('event.cancel_request');?>
    </span>
</button>
<?php elseif($membership === RELATION_TYPE_OWNER): ?>
<button class="btn btn-default btn-default btn-sm"
        data-object='<?php echo $objectTxt;?>' disabled>
    <span class="ion-checkmark"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('event.owner');?>
    </span>
</button>
<?php elseif(is_array($membership)): ?>
<div class="btn-event">
    <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="btn-dropdown">
        <span class="ion-checkmark"></span>
        <span class="btn-txt"><?php echo $this->helper()->text('event.joined_event');?></span>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li data-toggle="btn-event-addlist"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('core.add_to_interest_list');?>
            </a></li>
        <li data-toggle="btn-event-invite"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('friend.invite_friends');?>
            </a></li>
        <li role="separator" class="divider"></li>
        <li data-toggle="btn-event-leave"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('event.leave_event');?>
            </a></li>
    </ul>
</div>
<?php endif; ?>