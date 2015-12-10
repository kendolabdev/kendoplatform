<div class="attachment-wrap attachment-media attachment-ratio-85 link">
    <a class="attachment-stage noope" href="<?php echo $link->getOriginUrl();?>" target="_blank">
        <div class="attachment-content">
            <div class="attachment-content-stage">
                <?php if($link->hasThumbnail()): ?>
                <div class="attachment-thumb">
                    <div class="attachment-img"
                         style="background-image: url(<?php echo $link->getThumbnailUrl(); ?>)"></div>
                </div>
                <?php endif; ?>
                <div class="attachment-body">
                    <div class="attachment-body-stage">
                        <div class="attachment-title">
                            <div class="attachment-title-stage"><?php echo $link->getTitle(); ?></div>
                        </div>
                        <div class="attachment-desc">
                            <div class="attachment-desc-stage"><?php echo $link->getDescription() ?></div>
                        </div>
                        <div class="attachment-extra">
                            <div class="attachment-extra-stage"><?php echo $link->getProviderName();?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>