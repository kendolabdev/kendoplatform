<?php foreach($bundles as $bundle):?>
<?php echo $this->helper()->partial('base/feed/partial/feed-item', $bundle); ?>
<?php endforeach; ?>