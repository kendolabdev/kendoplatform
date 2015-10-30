<?php if($showSteps):?>
<p class="lead">Manage Steps</p>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($steps as $item): ?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $item->getStepName(); ?></td>
        <td>
            <?php echo $this->helper()->textLink('core.edit',array(),'admin',
            array('stuff'=>'core/manage-form/edit-field', 'fieldId'=>$item->getId())); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php if($showSections): ?>
<p class="lead">Manage Sections</p>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Step</th>
        <th>Name</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($sections as $item): ?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $item->getStepId(); ?></td>
        <td><?php echo $item->getSectionName(); ?></td>
        <td>
            <?php echo $this->helper()->textLink('core.edit',array(),'admin',
            array('stuff'=>'core/manage-form/edit-field', 'fieldId'=>$item->getId())); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<p class="lead">Manage Fields</p>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Field</th>
        <th>Plugin</th>
        <th>Section</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($fields as $item): ?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $item->getFieldName(); ?></td>
        <td><?php echo $item->getPluginId(); ?></td>
        <td>
            <?php echo $item->__get('section_name') ?>
        </td>
        <td>
            <?php echo $this->helper()->textLink('core.edit',array(),'admin',
            array('stuff'=>'core/manage-form/edit-field', 'fieldId'=>$item->getId())); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>