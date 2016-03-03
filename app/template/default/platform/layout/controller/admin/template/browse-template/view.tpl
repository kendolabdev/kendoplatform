<div class="page-heading">
    <h1 class="page-title">
        <?php echo $this->helper()->text('core_layout.manage_templates');?>
    </h1>
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <td>ID</td>
        <td>Template</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paging->items() as $item):?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $item->getTemplateName(); ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>