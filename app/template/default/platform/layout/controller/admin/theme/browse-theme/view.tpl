<table class="table table-bordered">
    <thead>
    <tr>
        <td>ID</td>
        <td>Theme</td>
        <td>Template</td>
        <td>Editing</td>
        <td>Is Active</td>
        <td>Is Default</td>
        <td>Options</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paging->items() as $item):?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $item->getTitle(); ?></td>
        <td><?php echo $item->getTemplateId();?></td>
        <td><?php echo $item->isEditing()?'<b class="text-danger">YES</b>':'no';?></td>
        <td><?php echo $item->isActive()?'yes':'no';?></td>
        <td><?php echo $item->isDefault()?'yes':'no';?></td>

        <td>
            <a href="<?php echo $this->helper()->url('admin',[
            'stuff'=> 'layout/theme/edit','id'=>$item->getId()]);?>">
                <?php echo $this->helper()->text('core.edit');?>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>