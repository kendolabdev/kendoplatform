<?php foreach($paging->items() as $item): ?>
<div class="<?php echo $lp->forAvatar('blog'); ?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb avatar avatar-sm" href="<?php echo $item->toHref();?>"
                   data-hover="card"
                   data-card="<?php echo $item->getPoster()->toToken();?>">
                    <span style="background-image: url(<?php echo $item->getPoster()->getPhoto('avatar_sm')?>);"></span>
                </a>

                <div class="card-body">
                    <div class="card-body-stage">
                        <a class="profile" href="<?php echo $item->toHref();?>" target="_blank">
                            <span><?php echo $item->getTitle();?></span>
                        </a>

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
            <a class="item-options btn btn-sm"
               data-toggle="options"
               data-remote="admin/blog/ajax/manage/options"
               data-object='<?php echo _escape($item->toTokenArray());?>'
               data-for="for-btn">
                <i class="ion-ios-arrow-down"></i>
            </a>
        </div>
    </div>
</div>
<?php endforeach; ?>
