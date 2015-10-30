<div class="options-content">
    <div class="card-beeber-header">
        <div class="clearfix">
            <strong>Invitations</strong>

            <div class="pull-right separate-cmd">
                <a href="<?php echo $this->helper()->url('find_friends');?>"><?php echo $this->
                    helper()->text('user.find_friends');?></a>
                <a href="<?php echo $this->helper()->url('user_settings', array('action'=>'privacy'));?>">Settings</a>
            </div>
        </div>
    </div>
    <div class="card-beeber-content">
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
    </div>
    <div class="card-beeber-footer text-center">
        <a href="<?php echo $this->helper()->url('requests');?>">View All</a>
    </div>
</div>