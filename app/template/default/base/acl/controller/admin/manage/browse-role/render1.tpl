<div class="page-heading">
    <h1 class="page-title">Manage Member Roles</h1>
    <div class="page-note">
        <form class="form form-inline">
            <?php echo $filter->asList();?>
            <div class="form-group">
                <br/>
                <button type="submit" class="btn btn-warning">Search</button>
            </div>
        </form>
    </div>
</div>
<div class="paging">
    <div class="paging-stage">
        <div class="paging-content card-space-md">
            <?php foreach($paging->items() as $item): ?>
            <div class="col-md-12 card-wrap card-media card-border-bottom">
                ID: <?php echo $item->getId(); ?> <br/>
                Name: <?php echo $item->getTitle(); ?> <br/>
                <?php echo $this->helper()->textLink('core.permission', [], 'admin',
                ['stuff'=>'acl/permission/edit','roleId'=>$item->getId()]); ?>
                <hr/>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
