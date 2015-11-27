<?php echo $form->open(); ?>

<div class="page-heading">
    <h1 class="page-title"><?php echo $form->getTitle();?></h1>
    <div class="page-note">
        <?php echo $form->getNote(); ?>
    </div>
</div>

<?php foreach($form->getElements() as $element):?>
<div class="clearfix form-group <?php if($element->isHidden()){echo 'sr-only';} ?>">
    <label class="control-label <?php if(!$element->hasLabel()){echo 'sr-only';} ?>">
        <?php echo $element->getLabel(); ?>
    </label>
    <div class="">
        <?php if($element->hasNote()): ?><p class="help-block"><?php echo $element->getNote(); ?></p><?php endif; ?>
        <?php echo $element->toHtml(); ?>
    </div>
    <div class="">
        <!--< setup privacy button for this type./>-->
    </div>
</div>
<?php endforeach; ?>


<div class="form-group">
    <?php if(!$form->hasElement('_submit')): ?>
    <button type="submit" class="btn btn-primary btn-sm" name="_submit"><?php echo $this->
        helper()->text('core.save_changes'); ?>
    </button>
    <?php endif; ?>
</div>
<?php echo $form->close(); ?>