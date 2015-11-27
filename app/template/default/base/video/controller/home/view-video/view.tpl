<div class="video-view">
    <div class="item-img hidden">
        <img src="<?php echo $video->getPhoto('high'); ?>" class="img-responsive" style="width:100%;"/>
        <div class="item-mask"></div>
    </div>

    <div class="item-embed">
        <?php echo $video->getEmbedCode([]); ?>
    </div>

    <div class="item-title">
        <?php echo $video->getTitle(); ?>
    </div>
    <div class="item-extra">
        <?php echo $this->helper()->text('video.posted_by');?>
        <a href="<?php echo $poster->toHref(); ?>" data-hover="card" data-card="<?php echo $poster->toToken();?>"><?php echo $poster->getTitle();?></a>
    </div>

    <div class="item-desc">
        <?php echo substr($video->getDescription(), 0, 100); ?>
    </div>
</div>
