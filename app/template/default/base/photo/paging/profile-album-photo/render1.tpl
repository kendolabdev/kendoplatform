<?php foreach($paging->items() as $item): ?>
<?php $album = $item->getAlbum(); $poster =  $item->getPoster();?>
<div class="<?php echo $lp->forMedia('photo'); ?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage"><a class="card-thumb" href="<?php echo $item->toHref();?>"
                                               data-toggle="spotlight" data-spotlight="1">
                <div class="card-img" style="background-image: url(<?php echo $item->getPhoto('440');?>)"></div>
            </a>

                <div class="card-body">
                    <div class="card-body-stage">
                        <div class="card-extra separate-cmd">
                            <a href="<?php echo $poster->toHref();?>" data-hover="card"
                               data-card="<?php echo $poster->toToken();?>">
                                by <?php echo $poster->getTitle();?>
                            </a>
                        </div>

                        <div class="card-extra separate-cmd">
                            <span><?php echo $this->helper()->lnLike($item); ?></span>
                            <span><?php echo $this->helper()->lnComment($item); ?></span>
                        </div>
                    </div>
                </div>
                <div class="item-options">
                    <div class="btn-group">
                        <a role="button"
                           class="right"
                           data-toggle="options"
                           data-for="for-btn"
                           data-remote="ajax/photo/photo/photo-options?photoId=<?php echo $item->getId();?>"
                           data-object="{}">
                            <i class="ion-ios-gear"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>