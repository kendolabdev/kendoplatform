<?php foreach($posters as $item): ?>
<?php $number =  $agg[$item->getId()]; ?>
<div class="itv-list itv-list-user">
    <div class="clearfix">
        <a class="pull-left" href="<?php echo $item->toHref();?>" data-hover="card" data-card="<?php echo $item->toToken();?>">
            <img class="img-profile" src="<?php echo $item->getPhoto('avatar_lg');?>" width="100" height="100"/>
        </a>

        <div class="clearfix">
            <div class="_4a itv-info">
                <div class="_4ab _4p"></div>
                <div class="_4ab">
                    <?php echo $this->helper()->link($item->getTitle(),
                    ['href'=>$item->toHref(),
                    'class'=>'profile',
                    'data-hover'=>'card',
                    'data-card'=>$item->toToken()]); ?> <br/>
                    <a href="<?php echo $item->toHref(['stuff'=>'blogs']);?>"><?php echo $this->helper()->text('blog.$number_post',array('$number'=>$number), $number);?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>