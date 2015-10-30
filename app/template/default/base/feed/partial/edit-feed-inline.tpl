<form method="post" onsubmit="return false;" class="form-inline-edit">
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="hidden" name="type" value="<?php echo $type; ?>"/>
    <input type="hidden" name="profileId" value="<?php echo $profileId; ?>"/>
    <input type="hidden" name="profileType" value="<?php echo $profileType; ?>"/>
    <input type="hidden" name="isMainFeed" value="<?php echo $isMainFeed; ?>"/>

    <div class="hidden olval">
        <?php echo $this->helper()->decorateStory($story);?>
    </div>
    <div class="form-content">
        <div class="form-body">
            <textarea
                    tabindex="-1"
                    autofocus
                    id="<?php echo $txtId;?>"
                    name="statusTxt"
                    rows="3"
                    placeholder="<?php echo $this->helper()->text('share.say_something_about_this');?>"
                    class="fc-mention-input mentions-input share-content-txt"><?php echo html_entity_decode($story); ?></textarea>
        </div>
        <div class="form-footer">
            <div class="text-right">
                <button type="button" class="btn btn-xs btn-danger" data-toggle="feed-edit-cancel">
                    <?php echo $this->helper()->text('core.cancel');?>
                </button>
                <button type="button" class="btn btn-xs btn-default" data-toggle="feed-edit-submit">
                    <?php echo $this->helper()->text('core.save_change');?>
                </button>
            </div>
        </div>
    </div>
</form>