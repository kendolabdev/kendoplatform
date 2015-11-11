<div class="page-heading">
    <div class="page-note">
        by <a href="<?php echo $poster->toHref();?>" data-hover="card"
              data-card="<?php echo $poster->toToken();?>"><?php echo $poster->getTitle();?></a>
        <span class="middot">&middot;</span>
        <span>
            <?php echo $this->helper()->timeago($album->getCreatedAt());?>
        </span>
    </div>
    <div class="row cmds">
        <div class="col-md-6 col-sm-6 col-xs-3">
            <a role="button" href="<?php echo $album->toHref();?>">
                <?php echo $this->helper()->text('photo.back_to_album'); ?>
            </a>
            <span class="middot">&middot;</span>
            <a href="<?php echo $currentUrl ?>" data-toggle="spotlight" data-spotlight="1">
                <?php echo $this->helper()->text('photo.open_viewer'); ?>
            </a>
            <span class="middot">&middot;</span>
            <a role="button"
               class="right"
               data-toggle="btn-options"
               data-for="for-btn"
               data-remote="ajax/photo/photo/photo-options?photoId=<?php echo $photo->getId();?>"
               data-object="{}">
                <?php echo $this->helper()->text('core.options'); ?>
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-9 text-right">
            <?php if(!empty($prevUrl) && !empty($nextUrl)): ?>
            <?php if(!empty($nextUrl)): ?>
            <a href="<?php echo $nextUrl;?>"><?php echo $this->helper()->text('photo.previous_photo');?></a>
            <?php endif; ?>
            <span class="middot">&middot;</span>
            <?php if(!empty($prevUrl)): ?>
            <a href="<?php echo $prevUrl;?>"><?php echo $this->helper()->text('photo.next_photo');?></a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="photo-view">
    <div class="photo-stage-ow">
        <div class="photo-stage-iw">
            <img src="<?php echo $photo->getPhoto('origin');?>?>" class="photo-spotlight"/>
        </div>
    </div>
</div>


<?php echo \App::layout()->renderBlock('\Activity\Block\ActivityAbout',['about'=> $photo]); ?>