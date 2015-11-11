<?php foreach($paging->items() as $item): ?>
<div>
    <h5><?php echo $item->getTitle();?></h5>

    <div>Version: <?php echo $item->getVersion(); ?></div>
    <h5 class="">
        <a role="button" class="btn btn-xs btn-info">
            Rebuild CSS
        </a>
        <a role="button" class="btn btn-xs btn-primary">
            Export
        </a>
    </h5>
    <hr/>
</div>
<?php endforeach; ?>