<?php if($paging->count()):?>
<div class="paging"
     ride="paging"
     data-endless=true
     data-pager='<?php echo _escape($paging->getPager()); ?>'
     data-query='<?php echo _escape($query); ?>'
     data-lp='<?php echo $lp; ?>'
     data-url="<?php echo $pagingUrl;?>">
    <div class="paging-stage">
        <div class="paging-content <?php echo $lp->get('card_space','card-space-md')?>">
            <?php echo $this->helper()->partial($lp->itemScript(),['paging'=>$paging,'lp'=>$lp,'langId'=>$langId]);?>
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
