<?php foreach($bundles as $bundle):?>
<?php echo $this->helper()->partial('platform/feed/partial/feed-item', $bundle); ?>
<?php endforeach; ?>