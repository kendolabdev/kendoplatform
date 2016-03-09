<?php $objectTxt= json_encode(array('type'=>$item->getType(), 'id'=>$item->getId())); ?>

<?php if($membership === null): ?>
<button data-toggle="btn-group-join" class="btn btn-default btn-default btn-sm"
        title="<?php echo $this->helper()->text('friend.join_group');?>"
        data-object='<?php echo $objectTxt;?>'>
    <span class="ion-person-add"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('group.join_group');?>
    </span>
</button>
<?php elseif(in_array($membership, array(-1,-2))): ?>
<button data-toggle="btn-group-cancel" class="btn btn-default btn-default btn-sm"
        title="<?php echo $this->helper()->text('friend.cancel_friend_request');?>"
        data-object='<?php echo $objectTxt;?>'>
    <span class="ion-person-add"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('group.cancel_request');?>
    </span>
</button>

<?php elseif($membership === RELATION_TYPE_OWNER): ?>
<button class="btn btn-default btn-default btn-sm"
        data-object='<?php echo $objectTxt;?>' disabled>
    <span class="ion-checkmark"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('group.owner');?>
    </span>
</button>

<?php elseif(is_array($membership)): ?>
<div class="btn-group">
    <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="btn-dropdown">
        <span class="ion-checkmark"></span>
        <span class="btn-txt"><?php echo $this->helper()->text('group.joined_group');?></span>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li data-toggle="btn-group-addlist"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('core.add_to_interest_list');?>
            </a></li>
        <li data-toggle="btn-group-invite"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('friend.invite_friends');?>
            </a></li>
        <li role="separator" class="divider"></li>
        <li data-toggle="btn-group-leave"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('group.leave_group');?>
            </a></li>
    </ul>
</div>
<?php endif; ?>