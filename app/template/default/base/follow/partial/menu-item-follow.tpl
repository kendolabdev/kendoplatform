<?php if($following == true): ?>
<li class="btn-follow" data-toggle="btn-follow"
        data-object='<?php echo _escape($attrs);?>'>
    <a role="button">
        <b class="ion-checkmark"></b>
    <span class="btn-txt">
        <?php echo $this->helper()->text('core.following'); ?>
    </span>
    </a>
</li>
<?php endif; ?>

<?php if($following == false): ?>
<li class="btn-follow" data-toggle="btn-follow"
        data-object='<?php echo _escape($attrs);?>'>
    <a role="button">
        <b class="ion-social-rss"></b>
    <span class="btn-txt">
        <?php echo $this->helper()->text('core.follow'); ?>
    </span>
    </a>
</li>
<?php endif; ?>