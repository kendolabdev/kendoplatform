<div class="clearfix attachment-share">
    <?php if(!empty($story)): ?>
    <div class="clearfix share-status-ow">
        <?php echo $story->toHtml(); ?>
    </div>
    <?php endif; ?>

    <?php if(!empty($attachment)): ?>
    <div class="clearfix share-att-ow">
        <?php echo $attachment->toHtml(); ?>
    </div>
    <?php endif; ?>
</div>