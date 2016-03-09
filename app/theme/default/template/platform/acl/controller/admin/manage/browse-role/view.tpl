<div class="paging">
    <div class="paging-stage">
        <div class="paging-content card-space-md">
            <?php foreach($paging->items() as $item): ?>
            <div class="col-md-12 card-wrap card-media card-border-bottom">
                ID: <?php echo $item->getId(); ?> <br/>
                Name: <?php echo $item->getTitle(); ?> <br/>
                <?php echo $this->helper()->textLink('core.permission', [], 'admin',
                ['any'=>'acl/permission/edit','roleId'=>$item->getId()]); ?>
                <hr/>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
