<?php foreach($form->getElements() as $element):?>
<?php if(false == $element->hasFormatValue()) continue; ?>
<div class="clearfix form-group <?php if($element->isHidden()){echo 'sr-only';} ?>">
    <label class="control-label <?php if(!$element->hasLabel()){echo 'sr-only';} ?>">
        <?php echo $element->getLabel(); ?>
    </label>
    <div class="">
        <?php echo $element->toFormatValue(); ?>
    </div>
</div>
<?php endforeach; ?>
