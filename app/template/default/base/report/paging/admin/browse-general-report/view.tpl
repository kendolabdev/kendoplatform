<?php foreach($paging->items() as $item): ?>
<?php
$poster = $item->getPoster();
if(!$poster) continue;
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
                        <a class="profile" href="<?php echo $poster->toHref();?>">
                            <?php echo $poster->getTitle()?>
                        </a>
                        <div class="card-extra">
                            <div class="card-extra-stage">
                                <?php echo $this->helper()->date($item->getCreatedAt()); ?>
                            </div>
                        </div>
                        <div class="card-desc">
                            <?php echo $item->getMessage(); ?>
                        </div>
                        <div class="pt-b separate-cmd">
                            <a role="button"
                               data-toggle="dismiss"
                               data-closest=".card-wrap"
                               data-url="ajax/core/report/delete-report"
                               data-object='<?php echo _escape($item->toTokenArray());?>'>
                                Delete Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>