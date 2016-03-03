<div class="share-status-ow">
    <?php if($poster !=null): ?>
    <a href="<?php $poster->toHref();?>" class="profile" data-hover="card"
       data-card="<?php echo $poster->toToken();?>"> <?php echo $poster->getTitle(); ?></a>
    <?php endif; ?>
    <div>
        <?php echo $this->helper()->decorateStory($status->getStory()); ?>
    </div>
</div>
