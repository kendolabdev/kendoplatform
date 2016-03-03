<div class="hyves-content">
    <div class="hyves-header">
        <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="hyves-title">
            <?php echo $this->helper()->text('core.who_liked_this_post');?>
        </h4>
    </div>
    <div class="hyves-body hyves-body-full liked-this-ow">
        <div class="poster-list">
            <?php if($paging->count()):?>
            <div class="paging scroll-box"
                 ride="paging"
                 data-endless="<?php echo $lp->get('endless',false);?>"
                 data-pager='<?php echo _escape($paging->getPager()); ?>'
                 data-query='<?php echo _escape($query); ?>'
                 data-lp='<?php echo $lp; ?>'
                 data-url="<?php echo $pagingUrl;?>">
                <div class="paging-stage">
                    <div class="paging-content">
                        <?php echo $this->helper()->partial($lp->itemScript(),['paging'=>$paging,'lp'=>$lp]);?>
                    </div>
                    <?php echo $paging->toHtml('more',[]); ?>
                </div>
            </div>
            <?php else: ?>
            <div class="paging-empty-result">
                <?php if(empty($emptyText)) $emptyText=  'core.there_are_no_items' ?>
                <?php echo $this->helper()->text($emptyText); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

