<div class="fs-footer-row fs-cmf-ow hidden" ride="commentComposer" data-link="true">
    <form class="clearfix" onsubmit="return false;">
        <input type="hidden" name="type" value="<?php echo $asset->getType();?>"/>
        <input type="hidden" name="id" value="<?php echo $asset->getId();?>"/>
        <input type="hidden" name="context" value="feed"/>
        <a class="pull-left avatar avatar-sm" role="button">
            <span style="background-image: url(<?php echo $poster->getPhoto('avatar_lg');?>)"></span>
        </a>

        <div class="fs-cmf-iaw">
            <div class="fc-metion-ow">
                <textarea
                        rows="1"
                        class="fc-mention-input mentions-input"
                        name="commentTxt"
                        data-toggle="comment-box"
                        placeholder="Write a comment..."></textarea>
            </div>
            <div class="fc-att-ow cmt-att-ow"></div>
            <div class="fs-cmf-sb">
                <button
                        type="submit"
                        class="btn btn-xs btn-primary"
                        data-toggle=""><?php echo $this->
                    helper()->text('activity.comment');?>
                </button>
            </div>
        </div>
    </form>
</div>