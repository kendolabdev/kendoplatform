<div class="page-heading">
    <h1 class="page-title"><?php echo $this->helper()->text('page.pages');?></h1>
</div>

<?php if($paging->count()):?>

<div class="paging"
     ride="paging"
     data-url="ajax/page/page/paging"
     data-pager='<?php echo _escape($pager);?>'
     data-query='<?php echo _escape($query);?>'
     data-endless="false">
    <div class="paging-inner <?php echo $lp->req('card_space','card-space-sm');?>">
        <?php echo $this->helper()->partial('platform/page/paging/browse-page',['paging'=>$paging,'profile'=>$profile,'lp'=>$lp]); ?>
    </div>
    <?php echo $paging->toHtml('more'); ?>
</div>

<?php else: ?>
<div class="paging-empty-result">
    <?php echo $this->helper()->text('page.there_are_no_pages'); ?>
</div>
<?php endif; ?>
