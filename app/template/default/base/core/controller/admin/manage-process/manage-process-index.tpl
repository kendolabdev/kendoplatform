<h5 class="lead">
    Manage Process
</h5>
<table class="table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Module</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($items as $item): ?>
    <tr>
        <td><?php echo $item->getText(); ?></td>
        <td><?php echo $item->getModuleName(); ?></td>
        <td>
            <?php echo $this->helper()->textLink('core.edit',array(),'admin', array('stuff'=>'core/manage-process/steps', 'contentType'=> $item->getContentType(), 'actionType'=>$item->getActionType())); ?>
            <span>&middot;</span>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>

</table>