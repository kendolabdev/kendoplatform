<div class="hyves-content">
    <div class="hyves-header">
        <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <h4 class="hyves-title"><?php echo $this->helper()->text('core.shared_this');?></h4>
    </div>
    <div class="hyves-body hyves-body-full shared-this-ow">
        <div ride="paging"
             class="paging scroll-box"
             id="<?php echo $containerId; ?>"
             data-url="ajax/feed/feed/paging"
             data-endless=1
             data-continue=1
             data-pager="{}"
             data-query='<?php echo _escape($query);?>'>
            <div class="paging-stage">
                <div class="paging-content">
                    <?php foreach($paging->items() as $bundle):?>
                    <?php echo $this->helper()->partial('base/feed/partial/feed-item', $bundle); ?>
                    <?php endforeach; ?>
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
    </div>
</div>