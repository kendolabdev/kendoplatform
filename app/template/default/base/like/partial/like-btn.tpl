<?php $objectTxt= json_encode(array('type'=> $item->getType(), 'id'=>$item->getId()));?>
<?php if($likeStatus == 0): ?>
<button class="btn btn-default btn-sm" data-toggle="btn-like-add" data-object='<?php echo $objectTxt;?>'>
    <span class="ion-thumbsup"></span>
    <span class="btn-txt"><?php echo $this->helper()->text('core.like');?></span>
</button>
<?php endif;?>

<?php if($likeStatus == 1): ?>
<div class="btn-group">
    <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="btn-dropdown">
        <span class="ion-checkmark"></span>
        <span class="btn-txt"><?php echo $this->helper()->text('core.liked');?></span>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li data-toggle="btn-friend-addlist" data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('core.add_to_interest_list');?>
            </a></li>

        <li data-toggle="link-follow-toggle" data-object='<?php echo $objectTxt;?>'>
            <?php echo $this->helper()->partial('/base/core/partial/follow-toggle-link',
            array('followStatus'=>$followStatus)); ?>
        </li>

        <li role="separator" class="divider"></li>
        <li data-toggle="btn-like-remove" data-object='<?php echo $objectTxt;?>'>
            <a href="javascript:void(0)">
                <?php echo $this->helper()->text('core.unlike');?>
            </a></li>
    </ul>
</div>
<?php endif;?>