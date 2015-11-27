<?php foreach($paging->items() as $item): ?>
<div class="<?php echo $lp->forAvatar('blog'); ?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb avatar avatar-lg" href="<?php echo $item->toHref();?>"
                   data-hover="card"
                   data-card="<?php echo $item->getPoster()->toToken();?>">
                    <span style="background-image: url(<?php echo $item->getPoster()->getPhoto('avatar_lg')?>);"></span>
                </a>

                <div class="card-body">
                    <div class="card-body-stage">
                        <h3 class="card-title">
                            <a class="card-title-stage" href="<?php echo $item->toHref();?>">
                                <span><?php echo $item->getTitle();?></span>
                            </a>
                        </h3>

                        <div class="card-extra separate-cmd">
                <span>
                    <?php echo $this->helper()->date($item->getCreatedAt()); ?>
                </span>
                <span>
                    <?php echo $this->helper()->text('blog.$number_view', array('$number'=>$this->helper()->number($item->getViewCount())), $item->getViewCount()); ?>
                </span>
                <span>
                    <?php echo $this->helper()->text('core.by'); ?>
                    <a href="<?php echo $item->getPoster()->toHref();?>"
                       data-hover="card"
                       data-card="<?php echo $item->getPoster()->toToken();?>">
                        <span><?php echo $item->getPoster()->getTitle();?></span>
                    </a>
                </span>
                        </div>
                        <div class="card-desc">
                            <?php echo $item->getDescription();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
