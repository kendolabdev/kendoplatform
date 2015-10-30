<div class="page-heading">
    <h1 class="page-title"><?php echo $this->helper()->text('activity.who_like_this?');?></h1>

    <div class="page-note"></div>
</div>


<?php if($paging->count()):?>
<div class="paging"
     ride="paging"
     data-endless="true"
     data-pager='<?php echo _escape($pager); ?>'
     data-query='<?php echo _escape($query); ?>'
     data-url="ajax/activity/like/profile-like-paging">
    <div class="paging-inner <?php echo $lp->req('card_space','card-space-sm');?>">
        <?php echo $this->helper()->partial($lp->itemScript(),['paging'=>$paging,'lp'=>$lp]);?>
    </div>
    <?php echo $paging->toHtml('more',[]); ?>
</div>

<?php else: ?>
<div class="paging-empty-result">
    <?php echo $this->helper()->text('activity.there_is_no_likes'); ?>
</div>
<?php endif; ?>