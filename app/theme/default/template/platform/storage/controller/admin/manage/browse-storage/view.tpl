<form method="get">
    <div class="page-heading">
        <h1 class="page-title">Current Storage</h1>
    </div>
</form>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Active?</th>
        <th>Default?</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paging->items() as $item): ?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $item->getAdapter(); ?></td>
        <td><?php echo $item->isActive()?'yes':'no'; ?></td>
        <td><?php echo $item->isDefault()?'yes':'no'; ?></td>
        <td>
            <?php echo $this->helper()->textLink('core.edit', array(), 'admin', array('any'=>'storage/manage/edit',
            'id'=> $item->getId())); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>