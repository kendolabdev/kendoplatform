<div class="panel panel-default">
    <?php if($block->hasTitle()): ?>
    <div class="panel-heading"><?php echo $block->getTitle();?></div>
    <?php endif; ?>
    <div class="panel-body">
        <?php echo $block->getContent(); ?>
    </div>
</div>