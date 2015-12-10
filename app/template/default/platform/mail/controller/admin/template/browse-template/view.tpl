<div class="page-heading">
    <div class="page-title">
        Manage Mail Templates
    </div>
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

<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th><?php echo $this->helper()->text('core.title'); ?></th>
        <th><?php echo $this->helper()->text('core.subject'); ?></th>
        <th><?php echo $this->helper()->text('core.options'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paging->items() as $item): ?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $item->getTitle(); ?></td>
        <td><?php echo $item->getSubjectDefault(); ?></td>
        <td>
            <?php echo $this->helper()->textLink('core.edit', array(),
            'admin',['stuff'=>'mail/template/edit','name'=>$item->getTemplateName()]); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>