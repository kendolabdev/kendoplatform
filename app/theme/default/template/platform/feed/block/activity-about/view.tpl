<div class="card-wrap card-feed feed-about">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage feed-item fs-about-ow">
                <div class="card-header">
                    <div class="card-header-stage clearfix">
                        <a class="pull-left avatar avatar-md" href="<?php echo $poster->toHref();?>"
                           data-hover="card"
                           data-card="<?php echo $poster->toToken();?>">
                            <span style="background-image: url(<?php echo $poster->getPhoto('avatar_lg');?>)"></span>
                        </a>

                        <div class="fs-headline-msg">
                            <a class="profile" href="<?php echo $poster->toHref();?>" data-hover="card"
                               data-card="<?php echo $poster->toToken();?>"><?php echo $poster->getTitle(); ?></a>
                            <?php if(!empty($people)):?>
                            - with <?php echo $people; ?>
                            <?php endif; ?>

                            <?php if(!empty($place)):?>
                            - at <a href="<?php echo $place->toHref();?>"><?php echo $place->getTitle(); ?></a>
                            <?php endif; ?>
                            <div>
                    <span title="<?php echo $about->getCreatedAt();?>" class="timeago">
                        <?php echo $this->helper()->timeago($about->getCreatedAt());?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-card="card-body">
                    <div class="card-body-stage clearfix">
                        <?php if($hasStory): ?>
                        <div class="fs-story-ow">
                            <?php echo $this->helper()->decorateStory($story); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($this->helper()->logged() || $this->helper()->setting('activity','show_bar_for_guest')):?>
                <div class="card-extra">
                    <div class="card-extra-stage separate-cmd fs-asset-aw">
                        <span>
                            <?php echo $this->helper()->lnLike($about, $like->isLiked());?>
                        </span>
                        <span>
                            <?php echo $this->helper()->lnComment($about);?>
                        </span>
                        <span>
                            <?php echo $this->helper()->lnShare($about);?>
                        </span>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($this->helper()->logged() || $this->helper()->setting('activity','show_list_for_guest')):?>
                <div class="card-footer">
                    <div class="card-footer-stage fs-footer-iw">
                        <!--who like list-->
                        <div class="fs-footer-row fs-like-sample <?php echo $like->getCount() > 0? '': 'hidden';?>">
                            <?php echo $like->getSampleHtml(); ?>
                            <!--<a>An Nguyen</a> and <a role="button">19 others</a> like this.-->
                        </div>
                        <!--view more comment-->
                        <div class="fs-footer-row fs-cm-vm <?php echo $remainCommentCount>0?'':'hidden';?>">
                            <?php echo $this->helper()->lnViewMoreComment($about); ?>
                        </div>
                        <?php foreach(app()->commentService()->getCommentList($about, $limitCommentCount,0) as
                        $comment): ?>
                        <?php echo $this->helper() ->partial('platform/comment/partial/comment-item',
                        array('comment'=>$comment,'item'=>$about,'poster'=>$comment->getPoster())); ?>
                        <?php endforeach; ?>
                        <?php if(app()->auth()->logged()): ?>
                        <?php echo $this->helper()->partial('platform/comment/partial/comment-form', array(
                        'poster'=>app()->auth()->getViewer(),
                        'asset'=>$about));
                        ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>