<?php if($followStatus == 0): ?>
<a href="javascript:void(0)">
    <?php echo $this->helper()->text('core.follow');?>
</a>
<?php endif; ?>

<?php if($followStatus == 1): ?>
<a href="javascript:void(0)">
    <?php echo $this->helper()->text('core.following');?>
</a>
<?php endif; ?>