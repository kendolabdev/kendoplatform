<?php if($paging->count()):?>
<div class="paging"
     ride="paging"
     data-endless="true"
     data-pager='<?php echo _escape($pager); ?>'
     data-query='<?php echo _escape($query); ?>'
     data-url="ajax/activity/follow/profile-follower-paging">
    <div class="paging-inner <?php echo $lp->req('card_space','card-space-sm');?>">
        <?php echo $this->helper()->partial($lp->itemScript(),['paging'=>$paging,'lp'=>$lp]);?>
    </div>
    <?php echo $paging->toHtml('more',[]); ?>
</div>

<?php else: ?>
<div class="paging-empty-result">
    <?php echo $this->helper()->text('activity.there_is_no_following'); ?>
</div>
<?php endif; ?>
