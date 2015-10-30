<div class="options-content">
    <div class="card-beeber-header">
        <div class="clearfix">
            <strong><?php echo $this->helper()->text('message.inbox');?></strong>

            <div class="pull-right separate-cmd">
                <a href="#" data-toggle="btn-message-readall" data-context="inbox">
                    <?php echo $this->helper()->text('message.mark_all_read');?>
                </a>
                <a href="<?php echo $this->helper()->url('message_compose', array());?>">
                    <?php echo $this->helper()->text('message.new_message'); ?>
                </a>
            </div>
        </div>
    </div>
    <div class="card-beeber-content">
        <!--items-->
        <?php if($paging->count()):?>
        <div class="paging scroll-box notification-scroll"
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
        <!--/items-->
    </div>
    <div class="card-beeber-footer text-center">
        <a href="<?php echo $this->helper()->url('message_inbox');?>">
            <?php echo $this->helper()->text('message.view_all'); ?>
        </a>
    </div>
</div>