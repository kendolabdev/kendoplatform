<?php foreach($paging->items() as $item): ?>
<?php if(!$item) continue; ?>
<div class="itv-list itv-list-user">
    <div class="clearfix">
        <a class="pull-left" href="<?php echo $item->toHref();?>">
            <img class="img-profile" src="<?php echo $item->getPhoto('avatar_lg');?>" width="100" height="100"/>
        </a>

        <div class="clearfix">
            <div class="_4a itv-info">
                <div class="_4ab _4p"></div>
                <div class="_4ab">
                    <?php echo $this->helper()->link($item->getTitle(),
                    array('href'=>$item->toHref(),'class'=>'profile')); ?> <br/>
                    <?php echo $this->helper()->btnFriendCount($item);?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>