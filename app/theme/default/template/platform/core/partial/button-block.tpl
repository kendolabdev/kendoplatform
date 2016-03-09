
<?php if($blocking == true): ?>
<button class="btn-blocking btn btn-sm btn-default" data-toggle="btn-block"
        data-object='<?php echo _escape($attrs);?>'>
    <span class="ion-checkmark"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('core.blocking'); ?>
    </span>
</button>
<?php endif; ?>

<?php if($blocking == false): ?>
<button class="btn-blocking btn btn-sm btn-default" data-toggle="btn-block"
        data-object='<?php echo _escape($attrs);?>'>
    <span class="ion-lock-combination"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('core.block'); ?>
    </span>
</button>
<?php endif; ?>