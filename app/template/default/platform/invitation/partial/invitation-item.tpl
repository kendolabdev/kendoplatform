<div class="card-invitation clearfix">
    <div class="card-stage">
        <div class="card-item">
            <div class="item-media avatar avatar-sm">
                <span style="background-image: url(<?php echo $poster->getPhoto('avatar_md');?>)"></span>
            </div>
            <div class="item-body">
                <a href="<?php echo $item->toHref();?>" class="noope item-body" data-toggle="1">
                    <div class="headline">
                        <?php echo $headline;?>
                    </div>
                    <div class="pull-left info">
                        <small class="ion-clock"></small>
                        <small class="timeago"><?php echo $this->helper()->timeago($item->getCreatedAt());?></small>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button data-toggle="btn-invitation-cmd"
                                    data-obj='<?php echo _escape($attrs)?>'
                                    data-cmd="accept"
                                    data-ctx="profile"
                                    class="btn btn-default btn-xs">
                                <?php echo $this->helper()->text('core.accept');?>
                            </button>
                            <button data-toggle="btn-invitation-cmd"
                                    data-obj='<?php echo _escape($attrs)?>'
                                    data-cmd="accept"
                                    data-ctx="profile"
                                    class="btn btn-default btn-xs">
                                <?php echo $this->helper()->text('core.ignore');?>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>