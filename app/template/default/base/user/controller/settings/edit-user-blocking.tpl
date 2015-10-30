<?php if(count($blockingItems) ==0): ?>
<?php echo $this->helper()->text('core.there_no_blocking_users'); ?>
<?php endif; ?>
<?php foreach($blockingItems as $item): ?>
<div class="itv-list itv-list-user">
    <img src="<?php echo $item->getPhoto(220); ?>" width="100" height="100"/>
    <?php echo $this->helper()->link($item->getName(), array('class'=>'profile', 'href'=>$item->toHref()));?>
    <span>&middot;</span>
    <a href="#" data-toggle="btn-remove-blocking" data-object='<?php echo json_encode($item->toSimpleAttrs()); ?>'><?php echo $this->
        helper()->text('core.unblock'); ?>
    </a>
</div>
<?php endforeach; ?>