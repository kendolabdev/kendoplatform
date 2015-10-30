<div class="fs-footer-row cmt-item" data-id="<?php echo $comment->getId();?>">
    <div class="clearfix">
        <a class="pull-left avatar avatar-sm" role="button" href="<?php echo $poster->toHref(); ?>" data-hover="card"
           data-card="<?php echo $poster->toToken();?>">
            <span style="background-image: url(<?php echo $poster->getPhoto('avatar_sm');?>)"></span>
        </a>

        <div class="fs-cm-st">
            <a href="<?php echo $poster->toHref();?>" role="button" class="profile" data-hover="card"
               data-card="<?php echo $poster->toToken();?>"><?php echo $poster->
                getTitle();?></a> <span class="cmt-body-stage"><?php echo $this->
            helper()->decorateStory($comment->getContent()); ?></span>

            <?php if(!empty($attachment)): ?>
            <div class="cmt-att-ow">
                <?php echo $attachment->toHtml();?>
            </div>
            <?php endif; ?>

            <div class="fs-cm-asset separate-cmd">
                <span class="timeago"><?php echo $this->helper()->timeago($comment->getCreatedAt()); ?></span>
                <span>
                    <?php echo $this->helper()->lnLikeComment($comment); ?>
                </span>
                <span class="cmt-like-samples-ow <?php echo $comment->getLikeCount() > 0? '': 'hidden';?>">
                    <span class="cmt-like-samples">
                        <?php echo $this->helper()->listLikeSample($comment); ?>
                    </span>
                </span>
            </div>
        </div>
        <?php if(\App::auth()->logged()): ?>
        <a role="button"
           class="btn btn-xs comment-options"
           data-toggle="options"
           data-remote="ajax/comment/comment/options"
           data-object='<?php echo _escape($comment->toTokenArray());?>'>
            <i class="ion-ios-arrow-down"></i>
        </a>
        <?php endif; ?>
    </div>
</div>