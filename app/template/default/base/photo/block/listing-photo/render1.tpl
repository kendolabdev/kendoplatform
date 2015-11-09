<?php foreach($paging->items() as $item): ?>
<img src="<?php echo $item->getPhoto('440'); ?>" />
<?php endforeach; ?>