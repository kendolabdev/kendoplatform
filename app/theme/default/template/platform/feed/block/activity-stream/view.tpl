<div class="paging feed-stream"
     data-url="ajax/platform/feed/feed/paging"
     id="<?php echo $containerId; ?>"
     data-pager='[]'
     ride="paging"
     data-continue="1"
     data-query='<?php echo _escape($query);?>'
     data-endless='<?php echo $lp->get('endless');?>'>
    <div class="paging-stage">
        <div class="paging-content card-space-md">
            <?php echo $this->helper()->partial($lp->itemScript(),['paging'=>$paging,'lp'=>$lp]);?>
        </div>
        <div class="pager more">
            <a role="button" data-toggle="pager" class="pager-more" data-pager="more">
                <?php echo $this->helper()->text('core.load_more');?>
            </a>
            <a class="paging-loading-more hidden">
                <span class="paging-indicator"></span>
            </a>
        </div>
    </div>
</div>