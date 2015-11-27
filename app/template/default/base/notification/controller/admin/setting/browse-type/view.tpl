<div class="page-heading">
    <h1 class="page-title">Notification Types</h1>
</div>

<table class="table table-bordered">
    <thead>
    <tr>
        <td>Type</td>
        <td>Active</td>
        <td>User Edit</td>
        <td>
            Options
        </td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paging->items() as $item): ?>
    <tr>
        <td>
            <?php echo $item->getAdminTitle(); ?>
        </td>
        <td>
            <?php echo $item->isActive()? $this->helper()->text('core.yes'): $this->helper()->text('core.no'); ?>
        </td>
        <td>
            <?php echo $item->getUserEdit()? $this->helper()->text('core.yes'):
            $this->helper()->text('core.no'); ?>
        </td>
        <td>
            <?php echo $this->helper()->textLink('core.edit', array(),'admin',
            array('stuff'=>'notification/setting/edit-type','id'=> $item->getId())); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
