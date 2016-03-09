<?php foreach($paging->items() as $item): ?>
<?php if(null == ($poster = $item->getPoster())) continue;?>
<?php echo $item->toHtml(); ?>
<?php endforeach;?>