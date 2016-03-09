<?php foreach($paging->items() as $item): extract($item, EXTR_OVERWRITE);?>
<div class="col-md-12 card-wrap card-feed feed-stream" data-id="<?php echo $feed->getId();?>">
    <div data-feedId="<?php echo $feed->getId(); ?>" class="card-stage feed-item fs-ow">
        <div class="card-content">
            <div class="card-content-stage">
                <div class="card-header">
                    <div class="card-header-stage clearfix">
                        <a class="pull-left avatar avatar-md"
                           href="<?php echo $poster->toHref();?>" data-hover="card"
                           data-card="<?php echo $poster->toToken();?>">
                            <span style="background-image: url(<?php echo $poster->getPhoto('avatar_md');?>)"></span>
                        </a>

                        <div class="fs-headline-msg">
                            <?php echo $feed->getHeadline(); ?>
                            <?php if(!empty($people)):?>
                            - with <?php echo $people; ?>
                            <?php endif; ?>

                            <?php if(!empty($place)):?>
                            - at <a href="<?php echo $place->toHref();?>"><?php echo $place->getTitle(); ?></a>
                            <?php endif; ?>

                            <div class="separate-cmd">
                            <span title="<?php echo $feed->getCreatedAt();?>" class="timeago"><?php echo $this->
                                helper()->timeago($feed->getCreatedAt());?></span>
                            <span class="privacy">
                                <?php echo $this->helper()->labelPrivacy($about);?>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body-stage clearfix">
                        <div class="fs-story-ow <?php echo $hasStory?'':'hidden';?>">
                            <?php echo $this->helper()->decorateStory($story); ?>
                        </div>
                        <?php if($hasAttachment): ?>
                        <div class="fs-att-ow clearfix">
                            <?php echo $about->toHtml(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($this->helper()->logged() || $this->helper()->setting('activity','show_bar_for_guest')):?>
                <div class="card-extra">
                    <?php $assetArr = $about->toSimpleAttrs()?>
                    <div class="card-extra-stage separate-cmd fs-asset-aw">
                        <!--engage list-->
                        <?php echo $this->helper()->lnLike($about, $like->isLiked());?>
                        <?php echo $this->helper()->lnComment($about);?>
                        <?php echo $this->helper()->lnShare($feed);?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($this->helper()->logged() || $this->helper()->setting('activity','show_list_for_guest')):?>
                <div class="card-footer">
                    <div class="card-footer-stage">
                        <!--who like list-->
                        <div class="fs-footer-row fs-like-sample <?php echo $like->getCount() > 0? '': 'hidden';?>">
                            <?php echo $like->getSampleHtml(); ?>
                        </div>
                        <?php if($shareCount): ?>

                        <!--view more comment-->
                        <div class="fs-footer-row fs-share-sample <?php echo $shareCount>0?'':'hidden';?>">
                            <?php echo $this->helper()->listShareSample ($about); ?>
                        </div>
                        <?php endif; ?>

                        <?php if(($remain=$about->getCommentCount() - $limitCommentCount) >0): ?>
                        <!--view more comment-->
                        <div class="fs-footer-row fs-cm-vm <?php echo $remainCommentCount>0?'':'hidden';?>">
                            <?php echo $this->helper()->lnViewMoreComment($about); ?>
                        </div>
                        <?php endif; ?>

                        <?php echo $this->helper()->partial('platform/comment/partial/comment-list',
                        ['comments'=>$commentList,'about'=>$about,'viewer'=>app()->auth()->getViewer()]);?>

                        <?php if(app()->auth()->logged()): ?>
                        <?php echo $this->helper()->partial('platform/comment/partial/comment-form', array(
                        'poster'=>app()->auth()->getViewer(),
                        'asset'=>$about));
                        ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!--icon options-->
                <?php if($this->helper()->logged()): ?>
                <div class="item-options">
                    <a role="button"
                       class="btn btn-xs"
                       data-toggle="options"
                       data-for="for-icon"
                       data-remote="ajax/platform/feed/feed/options"
                       data-object='<?php echo _escape(json_encode($context)); ?>' >
                        <i class="ion-ios-arrow-down"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>