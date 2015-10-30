<form method="post" ride="shareComposer" data-link="false" async>
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="hidden" name="type" value="<?php echo $type; ?>"/>
    <input type="hidden" name="profileId" value="<?php echo $profileId; ?>"/>
    <input type="hidden" name="profileType" value="<?php echo $profileType; ?>"/>
    <div class="hyves-content">
        <div class="hyves-header">
            <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <div class="btn-group">
                <button name="shareType" class="btn btn-sm btn-info dropdown-toggle" type="button"
                        id="dropdownMenu1"
                        data-toggle="dropdown" aria-expanded="true">
                        <span class="btn-text"><?php echo $this->
                            helper()->text('share.share_on_your_own_profile');?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="button" data-toggle="btn-share-own"
                        data-label="<?php echo $this->helper()->text('share.share_on_your_own_profile');?>">
                        <a role="menuitem">
                            <?php echo $this->helper()->text('share.share_on_your_own_profile');?>
                        </a></li>

                    <?php if($canShareFriend): ?>
                    <!--can share friend-->
                    <li role="button" data-toggle="btn-share-friend"
                        data-label="<?php echo $this->helper()->text('share.share_on_friends_profile');?>">
                        <a role="menuitem">
                            <?php echo $this->helper()->text('share.share_on_friends_profile');?>
                        </a></li>
                    <!--/can share friend-->
                    <?php endif; ?>

                    <?php if($canShareGroup): ?>
                    <!--can share in group-->
                    <li role="button" data-toggle="btn-share-group"
                        data-label="<?php echo $this->helper()->text('share.share_on_groups_profile');?>">
                        <a role="menuitem">
                            <?php echo $this->helper()->text('share.share_on_groups_profile');?>
                        </a></li>
                    <!-- /can share group-->
                    <?php endif; ?>

                    <?php if($canSharePage): ?>
                    <!--can share in page-->
                    <li role="button" data-toggle="btn-share-page"
                        data-label="<?php echo $this->helper()->text('share.share_on_pages_profile');?>"><a
                            role="menuitem">
                        <?php echo $this->helper()->text('share.share_on_pages_profile');?>
                    </a></li>
                    <!--/can share in page-->
                    <?php endif; ?>

                    <li class="divider"></li>

                    <?php if($canShareMessage): ?>
                    <!--can share in private message-->
                    <li role="button" data-toggle="btn-share-message"
                        data-label="<?php echo $this->helper()->text('share.share_in_private_message');?>"><a
                            role="menuitem">
                        <?php echo $this->helper()->text('share.share_in_private_message');?>
                    </a></li>
                    <!--/can share in private message-->
                    <?php endif; ?>

                    <?php if($canShareFacebook): ?>
                    <!--can share facebook-->
                    <li role="button" data-toggle="btn-share-facebook"
                        data-label="<?php echo $this->helper()->text('share.share_via_facebook');?>"><a
                            role="menuitem">
                        <?php echo $this->helper()->text('share.share_via_facebook');?>
                    </a></li>
                    <!--/can share facebook-->
                    <?php endif; ?>
                </ul>
            </div>
            <div class="share-control-ow hidden">
                <input class="share-control-input"
                       type="text"
                       maxlength="30"
                       data-toggle="select"
                       data-multiple="false"
                       data-context="friend"
                       data-name="profile"
                       placeholder="<?php echo $this->helper()->text('core.share_on_');?>"/>
            </div>
        </div>
        <div class="hyves-body">
            <div class="share-content-ow">
                <div class="share-content-iw fc-metion-ow">
                        <textarea name="statusTxt"
                                  rows="3"
                                  data-toggle="share-box"
                                  placeholder="<?php echo $this->helper()->text('share.say_something_about_this');?>"
                                  class="fc-mention-input mentions-input share-content-txt"></textarea>
                </div>
            </div>
            <?php if(!empty($story)): ?>
            <div class="fs-story-ow fs-share">
                <?php echo $this->helper()->decorateStory($story);?>
            </div>
            <?php endif; ?>
            <div class="fs-att-ow fs-share">
                <?php echo $about->toHtml(); ?>
            </div>

        </div>
        <div class="hyves-footer">
            <button type="button" class="btn btn-primary" data-toggle="btn-share-sumbit"><?php echo $this->
                helper()->text('share.submit'); ?>
            </button>
        </div>
    </div>
</form>