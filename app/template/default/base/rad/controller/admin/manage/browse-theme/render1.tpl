<?php foreach($paging->items() as $item): ?>
<div>
    <h5><?php echo $item->getTitle();?></h5>

    <div>Version: <?php echo $item->getVersion(); ?></div>
    <h5 class="">
        <a role="button"
           class="btn btn-xs btn-info"
           data-toggle="ajax"
           data-url="admin/layout/ajax/theme/rebuild?id=<?php echo $item->getId();?>">
            Rebuild CSS
        </a>
        <a role="button"
           class="btn btn-xs btn-primary"
           data-toggle="ajax"
           data-url="admin/core/ajax/extension/export?id=<?php echo $item->getId();?>">
            Export
        </a>
    </h5>
    <hr/>
</div>
<?php endforeach; ?>