<?php foreach($paging->items() as $item): ?>
<div class="<?php echo $lp->forAvatar('user');?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb avatar avatar-lg" href="<?php echo $item->toHref();?>"
                   data-hover="card"
               data-card="<?php echo $item->toToken();?>">
                <span style="background-image: url(<?php echo $item->getPhoto('avatar_lg');?>)"></span>
            </a>

                <div class="card-body">
                    <div class="card-body-stage">
                        <div class="card-body-right">
                            <div class="card-cell card-body-right-stage">
                                <?php echo $item->btnMembership();?>
                            </div>
                        </div>
                        <div class="card-body-left">
                            <div class="card-cell card-body-left-stage">
                                <h3 class="card-title">
                                    <a class="card-title-stage" href="<?php echo $item->toHref();?>"
                                       role="button" data-hover="card"
                                       data-card="<?php echo $item->toToken();?>">
                                        <?php echo $item->getTitle();?>
                                    </a>
                                </h3>

                                <div class="card-extra">
                                    <div class="card-extra-stage separate-cmd">
                                        <?php echo $item->btnMemberCount(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>