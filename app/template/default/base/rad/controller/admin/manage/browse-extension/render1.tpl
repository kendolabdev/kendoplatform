<?php foreach($paging->items() as $item): ?>
<div>
    <h5><?php echo $item->getTitle();?></h5>

    <div>Version: <?php echo $item->getVersion(); ?></div>
    <hr/>
</div>
<?php endforeach; ?>