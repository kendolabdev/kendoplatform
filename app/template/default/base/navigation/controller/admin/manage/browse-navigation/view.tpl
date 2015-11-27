<table class="table">
    <thead>
    <tr>
        <td>Name</td>
        <td><?php echo $this->helper()->text('core.options');?></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paging->items() as $item): ?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $this->
            helper()->textLink('core.edit',[],'admin',['stuff'=>'navigation/manage/edit','id'=>$item->getId()]); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
