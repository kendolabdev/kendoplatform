<form method="post" class="form-status" data-target="#<?php echo $targetId;?>" ride="feedComposer"
      data-link="true">
    <input type="hidden" name="profileId" value="<?php echo $profile->getId();?>"/>
    <input type="hidden" name="profileType" value="<?php echo $profile->getType();?>"/>

    <div class="fc-ow">
        <div class="fc-header-ow">
            <div class="fc-header-tabs">
                <?php echo $headerHtml;?>
            </div>
            <div class="ajax-indicator small right"></div>
        </div>

        <div class="fc-body-ow">
            <div class="fc-metion-ow">
                <textarea
                        rows="1"
                        class="fc-mention-input mentions-input"
                        name="statusTxt"
                        data-toggle="status-box"
                        placeholder="What's on your mind?"></textarea>
            </div>
        </div>

        <!-- attachment preview area-->
        <div class="fc-att-ow feed-att-ow">
            <div class="fc-att-row fc-att-photo hidden">
                <div class="clearfix">
                    <span class="fc-upload-photo-preview">
                    </span>
                    <a role="button"
                       class="fc-att-photo-item-add"
                       data-toggle="fc-btn-photo"
                       data-target="#hidden-attatch-photos">
                        <span class="preview"></span>
                    </a>
                </div>
            </div>
            <div class="fc-att-row fc-att-people hidden" data-toggle="fc-ph-people">
                <div class="clearfix">
                    <div class="tag-input-ow fc-att-people-ow">
                        <input class="fc-att-people-input" type="text" name="peopleTxt" value=""
                               placeholder="Who were with you?"
                               maxlength="30"
                               data-toggle="select"
                               data-name="people"
                               data-multiple="true"
                               data-context="friend"/>
                    </div>
                </div>
            </div>
            <div class="fc-att-row fc-att-emotion hidden"></div>
            <div class="fc-att-row fc-att-location hidden">
                <div class="fc-att-location-ow">
                    <div class="hidden token-ow">
                    </div>
                    <div class="input-ow">
                        <input class="fc-att-location-input" type="text" name="placeTxt" value=""
                               placeholder="Where were this taken?" data-toggle="placeinput"/>
                        <a class="cleanup ion-backspace hidden" data-toggle="btn-remove-token"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="fc-footer-ow">
            <div class="clearfix">
                <div class="pull-left">
                    <div class="fc-footer-tools">
                        <?php echo $footerHtml;?>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="fc-footer-tools-right">
                        <?php if ($canControlPrivacy): ?>
                        <?php echo $privacyButton->toHtml();?>
                        <?php endif;?>

                        <button
                                data-toggle="fc-btn-submit"
                                type="button"
                                class="btn btn-sm btn-primary"><?php echo $this->
                            helper()->text('core.submit');?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>