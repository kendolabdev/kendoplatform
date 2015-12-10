<div class="page-heading">
    <h1 class="page-title">Step Sections For "<?php echo $this->helper()->text($stepTitle);?>"</h1>
    <div class="page-note">
    </div>
</div>

<!--toolbar-->
<div class="btn-toolbar">
    <div class="btn-group">
        <a class="btn btn-sm btn-default"
           href="<?php echo $this->helper()->url('admin', array('stuff'=> 'core/manage-process/index'));?>">
            All Process
        </a>
        <a class="btn btn-sm btn-default"
           href="<?php echo $this->helper()->url('admin', array('stuff'=> 'core/manage-process/steps','contentType'=>$step->getContentType(), 'actionType'=>$step->getActionType()));?>">
            All Steps
        </a>
        <a class="btn btn-sm btn-default"
           href="<?php echo $this->helper()->url('admin', array('stuff'=> 'core/manage-process/add-section','stepId'=> $stepId));?>">
            Add Section
        </a>
        <a class="btn btn-sm btn-default"
           href="<?php echo $this->helper()->url('admin', array('stuff'=> 'core/manage-process/add-field','stepId'=> $stepId));?>">
            Add Field
        </a>
    </div>

</div>
<!--/toolbar-->
<br/>
<form method="post">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Label</th>
            <th>Key</th>
            <th>Sort</th>
            <th>Active</th>
            <th>Required</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($sections as $sectionIndex=>$section): ?>
        <tr class="bg-info">
            <td>
                <strong><?php echo $this->helper()->text($section->getTitle()); ?> <sup>(section)</sup></strong>
            </td>
            <td>
                <?php echo $section->getName(); ?>
            </td>
            <td><input type="text" name="sectionOrders[<?php echo $section->getId(); ?>]"
                       value="<?php echo $sectionIndex;?>" required="true" size="2" maxlength="2"/></td>
            <td><?php echo $section->isActive()?'yes': 'no';?></td>
            <td><?php echo $section->isRequired()?'yes': 'no';?></td>
            <td>
                <?php echo $this->helper()->link('Edit', array(), 'admin',
                array('stuff'=>'core/manage-process/edit-section', 'sectionId'=> $section->getId())); ?>
                <span>&middot;</span>
                <?php echo $this->helper()->link('Delete', array(), 'admin',
                array('stuff'=>'core/manage-process/delete-section', 'sectionId'=> $section->getId())); ?>
            </td>
        </tr>
        <?php foreach($section->getFields() as $fieldIndex=>$field) : ?>
        <tr class="">
            <td><?php echo $this->helper()->text($field->getTitle()); ?>
                <?php echo $field->isActive()?'':'<sup>(hidden)</sup>'; ?>
            </td>
            <td>
                <?php echo $this->helper()->text($field->getName()); ?>
            </td>
            <td><input type="text" name="fieldOrders[<?php echo $field->getId(); ?>]"
                       value="<?php echo $fieldIndex;?>" required="true" size="2" maxlength="2"/></td>
            <td><?php echo $field->isActive()?'yes': 'no';?></td>
            <td><?php echo $field->isRequired()?'yes': 'no';?></td>
            <td>
                <?php echo $this->helper()->textLink('core.style', array(), 'admin',
                array('stuff'=>'core/manage-process/edit-field-style', 'fieldId'=> $field->getId())); ?>
                <span>&middot;</span>
                <?php echo $this->helper()->textLink('core.edit', array(), 'admin',
                array('stuff'=>'core/manage-process/edit-field', 'fieldId'=> $field->getId())); ?>
                <span>&middot;</span>
                <?php echo $this->helper()->textLink('core.rules', array(), 'admin',
                array('stuff'=>'core/manage-process/list-field-rules', 'fieldId'=> $field->getId())); ?>
                <span>&middot;</span>
                <?php echo $this->helper()->textLink('core.translation', array(), 'admin',
                array('stuff'=>'core/i18n/phrases', 'q'=> $field->getTitle())); ?>
                <span>&middot;</span>
                <?php echo $this->helper()->textLink('core.delete', array(), 'admin',
                array('stuff'=>'core/manage-process/delete-field', 'fieldId'=> $field->getId())); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="">
        <button class="btn btn-primary btn-sm" type="button" name="_submit" onclick="this.form.submit()">Save Orders
        </button>
    </div>
</form>