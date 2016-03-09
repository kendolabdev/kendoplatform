<?php if($blocking == true): ?>
<li class="btn-blocking" data-toggle="btn-block" data-object='<?php echo _escape($attrs);?>'>
    <a class="" role="button">
        <b class="ion-checkmark"></b>
        <span class="btn-txt">
            <?php echo $this->helper()->text('core.blocking'); ?></span>
    </a>
</li>
<?php endif; ?>

<?php if($blocking == false): ?>
<li class="btn-blocking" data-toggle="btn-block" data-object='<?php echo _escape($attrs);?>'>
    <a class="" role="button">
        <b class="ion-lock-combination"></b>
    <span class="btn-txt">
        <?php echo $this->helper()->text('core.block'); ?>
    </span>
    </a>
</li>
<?php endif; ?>