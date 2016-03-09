<?php if($hidden): ?>
<a role="button" tabindex="-1">
    <?php echo $this->helper()->text('core.i_want_to_see_this'); ?>
</a>
<?php else: ?>
<a role="button" tabindex="-1">
    <?php echo $this->helper()->text('core.i_don_want_to_see_this'); ?>
</a>
<?php endif;?>