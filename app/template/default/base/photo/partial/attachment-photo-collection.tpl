<!--show 1 photo-->
<div class="photo-collection-att-ow">
    <div class="off<?php echo $count;?>">
        <?php foreach($photos as $offset=>$photo): ?>
        <a href="<?php echo $photo->toHref(['context'=>'post']);?>" data-toggle="spotlight" data-spotlight="1"
           class="num<?php echo $offset;?>">
            <span class="img-view" style="background-image: url(<?php echo $photo->getPhoto('860');?>)">
            <?php if($remain && $offset == $count -1) echo $remain; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>