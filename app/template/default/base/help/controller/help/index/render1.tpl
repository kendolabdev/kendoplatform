<div class="page-heading">
    <h1 class="page-title">
        <?php echo $this->helper()->text('core.help_center');?>
    </h1>
</div>


<?php if($paging->count()):?>

<div class="paging"
     ride="paging"
     data-url="ajax/core/faqs/paging"
     data-endless="false"
     data-pager='<?php echo _escape($pager);?>'
     data-query='<?php echo _escape($query);?>'
     data-lp='<?php echo $lp;?>'>
    <div class="paging-inner card-space-md">
        <?php echo $this->helper()->partial('base/core/paging/browse-faq-category', ['paging'=>$paging,'lp'=>$lp]); ?>
    </div>
    <?php echo $paging->toHtml('more'); ?>
</div>
<?php else: ?>
<div class="paging-empty-result">
    <?php echo $this->helper()->text('core.there_are_no_more_faqs'); ?>
</div>
<?php endif; ?>
