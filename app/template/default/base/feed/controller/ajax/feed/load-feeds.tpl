<?php foreach($paging->items() as $item):?>
<?php echo $this->helper()->partial('platform/feed/partial/feed-item', $item); ?>
<?php endforeach; ?>