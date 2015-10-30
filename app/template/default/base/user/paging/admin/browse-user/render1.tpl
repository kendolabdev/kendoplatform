<?php foreach($paging->items() as $item): ?>
<div class="<?php echo $lp->forAvatar('user');?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb avatar avatar-md" href="<?php echo $item->toHref();?>"
                   target="_blank">
                    <span style="background-image: url(<?php echo $item->getPhoto('avatar_lg');?>)"></span>
                </a>

                <div class="card-body">
                    <div class="card-body-stage">
                        <div class="card-extra row">
                            <div class="col-md-3 col-sm-3">
                                <a class="profile" href="<?php echo $item->toHref();?>"
                                   role="button"
                                   target="_blank">
                                    <?php echo $item->getTitle();?></a><br/>
                                ID: <?php echo $item->getId(); ?><br/>
                                Role: <b><?php echo $item->getRole();?></b>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                Email: <b><?php echo $item->getEmail(); ?></b><br/>
                                Profile: <b><?php echo $item->getProfileName();?></b><br/>
                                Joined: <?php echo $this->helper()->date($item->getCreatedAt()); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                Verify: <?php echo $item->isVerified()?'yes':'no'; ?> <br/>
                                Active: <?php echo $item->isActive()?'yes':'no'; ?><br/>
                                Approved: <?php echo $item->isApproved()?'yes':'no'; ?>
                            </div>
                        </div>
                        <a class="item-options btn btn-sm"
                           data-toggle="options"
                           data-remote="ajax/user/admin/user/options"
                           data-object='<?php echo _escape($item->toTokenArray());?>'
                           data-for="for-btn">
                            <i class="ion-ios-arrow-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>