<a class="card-notification noope clearfix" href="<?php echo $item->toHref();?>">
    <div class="card-stage">
        <div class="card-content">
            <!--data-toggle="btn-notification" data-obj='<?php echo _escape($attrs)?>'-->
            <div class="item-media avatar avatar-sm">
                <span style="background-image: url(<?php echo $poster->getPhoto('avatar_md');?>)"></span>
            </div>
            <div class="item-body">
                <div class="headline">
                    <?php echo $headline;?>
                </div>
                <div class="info">
                    <small class="ion-clock"></small>
                    <small class="timeago"><?php echo $this->helper()->timeago($item->getCreatedAt());?></small>
                </div>
            </div>
        </div>
    </div>
</a>