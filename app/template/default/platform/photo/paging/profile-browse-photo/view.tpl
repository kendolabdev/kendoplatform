<?php foreach($paging->items() as $item): ?>
<?php $album = $item->getAlbum(); if(!$album) continue; ?>
<div class="<?php echo $lp->forMedia('photo'); ?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb" href="<?php echo $item->toHref();?>" data-toggle="spotlight" data-spotlight="1">
            <span class="card-img" style="background-image: url(<?php echo $item->getPhoto('440');?>)">
            </span>
                </a>

                <div class="card-body">
                    <div class="card-body-stage">
                        <h3 class="card-title">
                            <a class="card-title-stage" href="<?php echo $album->toHref();?>">
                                <?php echo $album->getTitle();?>
                            </a>
                        </h3>
                        <div class="card-extra">
                            <div class="card-extra-stage separate-cmd">
                                <span><?php echo $this->helper()->lnLike($item); ?></span>
                                <span><?php echo $this->helper()->lnComment($item); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-options">
                    <a role="button"
                       class="btn btn-xs"
                       data-toggle="options"
                       data-for="for-btn"
                       data-remote="ajax/platform/photo/photo/photo-options?photoId=<?php echo $item->getId();?>"
                       data-object="{}">
                        <i class="ion-ios-gear"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>