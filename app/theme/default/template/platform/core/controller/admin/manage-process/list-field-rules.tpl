<div class="page-heading">
    <h1 class="page-title">Validator "<?php echo $this->helper()->text($field->getTitle()); ?></h1>
    <div class="page-note">
    </div>
</div>

<form method="post" class="form">
<ul class="list-unstyled">
<?php foreach($ruleOptions as $item): ?>
    <li>
        <h5><?php echo $this->helper()->text($item['label']); ?></h5>
        <p>
            <?php echo $this->helper()->text($item['note']); ?>
        </p>
        <p>
            <?php echo $this->helper()->textLink('core.edit', array(), 'admin', array('any'=>'core/manage-process/edit-field-rule', 'ruleId'=> $item['value'], 'fieldId'=> $fieldId)); ?>
            <span>&middot;</span>
            <?php echo $this->helper()->textLink('core.delete', array(), 'admin', array('any'=>'core/manage-process/delete-field-rule', 'ruleId'=> $item['value'], 'fieldId'=> $fieldId)); ?>
        </p>
    </li>
<?php endforeach; ?>
</ul>
</form>