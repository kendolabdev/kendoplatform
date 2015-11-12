<?php foreach($form->getElements() as $element):?>
<div class="clearfix form-group <?php if($element->isHidden()){echo 'sr-only';} ?>">
    <label class="control-label <?php if(!$element->hasLabel()){echo 'sr-only';} ?>">
        <?php echo $element->getLabel(); ?>
    </label>

    <div class="">
        <?php if($element->hasNote()): ?><p class="help-block"><?php echo $element->getNote(); ?></p><?php endif; ?>
        <?php echo $element->toHtml(); ?>
    </div>
</div>
<?php endforeach; ?>
