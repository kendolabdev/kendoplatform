<div class="page-heading">
    <h1 class="page-title">Manage Step</h1>

    <div class="page-note">
    </div>
</div>

<!--toolbar-->
<div class="btn-toolbar">
    <div class="btn-group">
        <a class="btn btn-sm btn-default"
           href="<?php echo $this->helper()->url('admin', array('any'=> 'core/manage-process/index'));?>">
            All Process
        </a>
        <a class="btn btn-sm btn-default"
           href="<?php echo $this->helper()->url('admin', array('any'=> 'core/manage-process/add-step','contentType'=> $contentType, 'actionType'=>$actionType));?>">
            Add Step
        </a>
    </div>
</div>
<!--/toolbar-->

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Step Number</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($steps as $item): ?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $this->helper()->text($item->getTitle()); ?></td>
        <td><?php echo $item->getStepNumber(); ?></td>
        <td>
            <?php echo $this->helper()->textLink('core.edit',array(),'admin',
            array('any'=>'core/manage-process/edit-step', 'stepId'=>$item->getId())); ?>
            <span>&middot;</span>
            <?php echo $this->helper()->textLink('core.sections',array(),'admin',
            array('any'=>'core/manage-process/step-detail', 'stepId'=>$item->getId())); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>