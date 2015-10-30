<a role="button" data-toggle="comment-more" data-object='<?php echo $about->toTokenJson();?>'>
    <i class="ion-android-chat"></i> <?php echo $this->helper()->text('core.view_more_comments');?>
</a>
<span class="cm-pager-info">
    <span class="counter"><?php echo $counter; ?></span> of <span class="total"><?php echo $total ?></span> comments
</span>