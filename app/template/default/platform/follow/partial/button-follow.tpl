<?php if($following == true): ?>
<button class="btn-follow btn btn-sm btn-default" data-toggle="btn-follow"
        data-object='<?php echo _escape($attrs);?>'>
    <span class="ion-checkmark"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('core.following'); ?>
    </span>
</button>
<?php endif; ?>

<?php if($following == false): ?>
<button class="btn-follow btn btn-sm btn-default"
        data-toggle="btn-follow"
        data-object='<?php echo _escape($attrs);?>'>
    <span class="ion-social-rss"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('core.follow'); ?>
    </span>
</button>
<?php endif; ?>