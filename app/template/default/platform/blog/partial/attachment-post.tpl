<a class="noope blog-post-att-ow" href="<?php echo $post->toHref(); ?>">
    <div class="item-info">
        <div class="item-title"><?php echo $post->getTitle(); ?></div>
        <div class="item-desc"><?php echo substr($post->getDescription(),0, 225); ?></div>
    </div>
</a>