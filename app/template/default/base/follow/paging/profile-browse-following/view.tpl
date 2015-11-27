<?php foreach($paging->items() as $follow): ?>
<?php $item = $follow->getParent(); ?>
<div class="<?php echo $lp->forAvatar('user');?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb avatar avatar-lg" href="<?php echo $item->toHref();?>" data-hover="card"
                   data-card="<?php echo $item->toToken();?>">
                    <span style="background-image: url(<?php echo $item->getPhoto('avatar_lg');?>)"></span>
                </a>
                <div class="card-body">
                    <div class="card-body-stage">
                        <h3>
                            <a class="card-title" href="<?php echo $item->toHref();?>"
                               role="button" data-hover="card"
                               data-card="<?php echo $item->toToken();?>">
                                <?php echo $item->getTitle();?>
                            </a>
                        </h3>
                        <div class="card-extra">
                            <?php echo $item->btnMemberCount(); ?>
                        </div>
                        <div class="card-desc">
                            <?php echo $item->btnMembership();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>