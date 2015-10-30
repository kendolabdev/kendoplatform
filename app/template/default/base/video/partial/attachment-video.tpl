<div class="attachment-wrap attachment-media attachment-ratio-85 video">
    <a class="attachment-stage noope" href="<?php echo $video->toHref();?>" role="button">
        <div class="attachment-content">
            <div class="attachment-content-stage">
                <div class="attachment-thumb">
                    <div class="attachment-img" style="background-image: url(<?php echo $video->getPhoto('origin'); ?>)"></div>
                    <div class="attachment-mask"></div>
                    <div class="attachment-duration"><?php echo $video->getDuration();?></div>
                </div>
                <div class="attachment-body">
                    <div class="attachment-body-stage">
                        <div class="attachment-title">
                            <div class="attachment-title-stage">
                                <?php echo $video->getTitle(); ?>
                            </div>
                        </div>
                        <div class="attachment-desc">
                            <div class="attachment-desc-stage">
                                <?php echo $video->getDescription(); ?>
                            </div>
                        </div>
                        <?php if($video->isExternal()): ?>
                        <div class="attachment-extra">
                            <?php echo $video->getProviderName(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>