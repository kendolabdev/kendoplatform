<?php $objectTxt= json_encode(array('type'=>$item->getType(), 'id'=>$item->getId(), 'itemId'=> $for->getId(),'itemType'=>$for->getType())); ?>

<?php if($membership === 0): ?>
<button data-toggle="btn-group-join" class="btn btn-default btn-default btn-sm"
        title="<?php echo $this->helper()->text('friend.join_group');?>"
        data-object='<?php echo $objectTxt;?>'>
    <span class="ion-person-add"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('group.send_invite');?>
    </span>
</button>
<?php elseif(in_array($membership, array(-1,-2))): ?>
<div class="btn-group">
    <button data-toggle="btn-group-accept" class="btn btn-default btn-default btn-sm"
            title="<?php echo $this->helper()->text('friend.cancel_friend_request');?>"
            data-object='<?php echo $objectTxt;?>'>
        <span class="ion-person-add"></span>
        <span class="btn-txt">
            <?php echo $this->helper()->text('group.accept_request');?>
        </span>
    </button>
    <button data-toggle="btn-group-ignore" class="btn btn-default btn-default btn-sm"
            title="<?php echo $this->helper()->text('group.ignore_request');?>"
            data-object='<?php echo $objectTxt;?>'>
        <span class="ion-person-add"></span>
        <span class="btn-txt">
            <?php echo $this->helper()->text('group.ignore_request');?>
        </span>
    </button>
</div>
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
        <li data-toggle="btn-group-promote"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php if(in_array(RELATION_TYPE_OFFICER, $membership)): ?>
                <span class="ion-checkmark"></span>
                <?php endif; ?>
                <?php echo $this->helper()->text('group.add_to_officer');?>
            </a></li>
        <li data-toggle="btn-group-promote"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php if(in_array(RELATION_TYPE_EDITOR, $membership)): ?>
                <span class="ion-checkmark"></span>
                <?php endif; ?>
                <?php echo $this->helper()->text('group.add_to_editor');?>
            </a></li>
        <li data-toggle="btn-group-promote"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php if(in_array(RELATION_TYPE_ADMIN, $membership)): ?>
                <span class="ion-checkmark"></span>
                <?php endif; ?>
                <?php echo $this->helper()->text('group.add_to_admin');?>
            </a></li>
        <li role="separator" class="divider"></li>
        <li data-toggle="btn-group-remove"
            data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('group.remove_member');?>
            </a></li>
    </ul>
</div>
<?php endif; ?>