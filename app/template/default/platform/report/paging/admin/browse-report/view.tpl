<?php foreach($paging->items() as $item):
$about  = $item->getAbout();
$poster = $item->getPoster();
if(!$about || !$poster) continue;
?>
<div class="col-md-12 card-wrap card-avatar card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <a class="card-thumb avatar avatar-sm" href="<?php echo $poster->toHref();?>"
                   data-hover="card"
                   data-card="<?php echo $poster->toToken();?>">
                    <span style="background-image: url(<?php echo $poster->getPhoto('avatar_sm')?>);"></span>
                </a>
                <div class="card-body">
                    <div class="card-body-stage">
                        <a class="profile" href="<?php echo $about->toHref();?>">
                            <?php echo $poster->getTitle(); ?>
                        </a>
                        <div class="separate-cmd">
                            <span>about <a target="_blank" href="<?php echo $about->toHref();?>"><?php echo $item->getAboutType()  ,'#', $item->getAboutId();?></a></span>
                            <span>at <?php echo $this->helper()->date($item->getCreatedAt()); ?></span>
                        </div>
                        <div class="card-desc">
                            <?php echo $item->getMessage(); ?>
                        </div>
                        <div class="card-extra separate-cmd">
                            <a role="button"
                               data-toggle="dismiss"
                               data-closest=".card-wrap"
                               data-url="ajax/platform/core/report/delete-report"
                               data-object='<?php echo _escape($item->toTokenArray());?>'>
                                Delete Report
                            </a>
                            <a role="button"
                               data-toggle="dismiss"
                               data-closest=".card-wrap"
                               data-url="ajax/platform/core/report/delete-content"
                               data-object='<?php echo _escape($item->toTokenArray());?>'>
                                Delete Content
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>