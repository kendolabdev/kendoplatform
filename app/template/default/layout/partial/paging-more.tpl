<div class="pager more <?php echo $paging->hasNext()?'': 'hidden';?>">
    <a role="button" data-toggle="pager" class="pager-more" data-pager="more">
        <?php echo $this->helper()->text('core.load_more');?>
    </a>
    <a class="paging-loading-more hidden">
        <span class="paging-indicator"></span>
    </a>
</div>