<?php foreach($paging->items() as $item): ?>
<div class="<?php echo $lp->forMedia('video'); ?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb" href="<?php echo $item->toHref();?>">
                    <div class="card-img" style="background-image: url(<?php echo $item->getPhoto('hight');?>)">
                        <div class="card-mask"></div>
                        <div class="card-duration"><?php echo $item->getDuration();?></div>
                    </div>
                </a>
                <div class="card-body">
                    <div class="card-body-stage">
                        <a class="profile" href="<?php echo $item->toHref();?>" target="_blank">
                            <?php echo $item->getTitle(); ?>
                        </a>
                        <div class="card-extra">
                            <div class="card-extra-stage separate-cmd">
                                <span>
                                    <?php echo $this->helper()->date($item->getCreatedAt()); ?>
                                </span>
                                <span>
                                    <?php echo $this->
                                    helper()->text('video.view_number',['$number'=>$item->getViewCount()], $item->getViewCount()); ?>
                                </span>
                                <?php if(null != $item->getPoster()):?>
                                <span>
                                    by <a data-hover="card"
                                          data-card="<?php echo $item->getPoster()->toToken();?>"
                                          href="<?php echo $item->getPoster()->toHref();?>">
                                    <?php echo $item->getPoster()->getTitle();?>
                                </a>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-desc">
                            <p class="card-desc-stage">
                                <?php echo $item->getDescription();?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>