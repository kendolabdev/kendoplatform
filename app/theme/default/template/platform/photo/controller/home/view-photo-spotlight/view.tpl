<div class="spotlight-content-iw">
    <div class="spotlight-left">
        <div class="spotlight-stage-ow">
            <img src="<?php echo $photo->getPhoto('origin');?>?>" class="spotlight-photo"/>
        </div>

        <?php if(!empty($nextUrl)): ?>
        <a class="spotlight-pager next" href="<?php echo $nextUrl;?>" data-toggle="spotlight" data-spotlight="1">
            <i class="ion-chevron-right"></i>
        </a>
        <?php endif;?>

        <?php if(!empty($prevUrl)): ?>
        <a class="spotlight-pager prev" href="<?php echo $prevUrl;?>" data-toggle="spotlight" data-spotlight="1">
            <i class="ion-chevron-left"></i>
        </a>
        <?php endif;?>

        <div class="footer-ow">
            <div class="footer-iw">
                <a class="info-title" href="<?php echo $album->toHref();?>">
                    <?php echo $album->getTitle(); ?>
                </a>
                <?php if($this->helper()->logged()): ?>
                <div class="info-cmds">
                    <div class="cmds-left">
                        by <a href="<?php echo $poster->toHref();?>" data-hover="card"
                              data-card="<?php echo $poster->toToken();?>"><?php echo $poster->getTitle();?></a>
                        <span class="middot">&middot;</span>
                        <span>
                            <?php echo $this->helper()->timeago($photo->getCreatedAt());?>
                        </span>
                    </div>
                    <div class="cmds-right">
                        <a href="">Add Tags</a>
                        <span class="middot">&middot;</span>
                        <a role="button"
                           class="right"
                           data-toggle="options"
                           data-for="for-link"
                           data-remote="ajax/platform/photo/photo/photo-options?photoId=<?php echo $photo->getId();?>"
                                >Options</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="spotlight-right">
        <div class="header-ow">
            <a class="ion-close" data-toggle="spotlight-close"></a>
        </div>
        <?php echo app()->layouts()->renderBlock('\Activity\Block\ActivityAboutBlock',['about'=> $photo]); ?>
    </div>
</div>