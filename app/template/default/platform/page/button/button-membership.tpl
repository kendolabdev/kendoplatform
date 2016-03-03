<?php if($likeStatus == 0): ?>
<button class="btn btn-default btn-sm"
        data-toggle="membership-like-toggle"
        data-eid=""
        data-object='<?php echo _escape($item->toTokenArray());?>'>
    <span class="ion-thumbsup"></span>
    <span class="btn-txt"><?php echo $this->helper()->text('core.like');?></span>
</button>
<?php endif;?>

<?php if($likeStatus == 1): ?>
<button class="btn btn-default btn-sm dropdown-toggle"
        data-toggle="options"
        data-remote="ajax/platform/page/page/membership-options"
        data-object='<?php echo _escape($item->toTokenArray());?>'>
    <span class="ion-checkmark"></span>
    <span class="btn-txt"><?php echo $this->helper()->text('core.liked');?></span>
    <span class="caret"></span>
</button>
<?php endif;?>