<?php foreach($paging->items() as $item): ?>
<div class="<?php echo $lp->forMedia('album'); ?>">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb" href="<?php echo $profile->toHref(['any'=>'album/'. $item->getId()]);?>">
                    <span class="card-img" style="background-image: url(<?php echo $item->getPhoto('440');?>)"></span>
                </a>

                <div class="card-body">
                    <div class="card-body-stage"><a class="card-title" role="button"
                                                    href="<?php echo $profile->toHref(['any'=>'album/'. $item->getId()]);?>"><?php echo $item->
                        getTitle();?></a>
                        <div class="card-extra separate-cmd">
                <span><?php echo $this->
                    helper()->text('photo.$number_photos',['$number'=>$item->getPhotoCount()],$item->getPhotoCount()); ?></span>
                        </div></div>
                </div>
                <div class="item-options">
                    <div class="btn-group">
                        <a role="button"
                           class="right"
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
</div>
<?php endforeach; ?>