<?php foreach($paging->items() as $item):?>
<?php echo $this->helper()->partial('base/feed/partial/feed-item', $item); ?>
<?php endforeach; ?>