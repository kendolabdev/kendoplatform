<?php echo $form->open(['class'=>'form form-inline form-search']);?>
    <?php foreach($form->getElements() as $element):?>
    <div class="form-group form-group-sm <?php if($element->isHidden()){echo 'sr-only';} ?>">
        <div class="">
            <?php if($element->hasNote()): ?><p class="help-block"><?php echo $element->getNote(); ?></p><?php endif; ?>
            <?php echo $element->toHtml(); ?>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="form-group form-group-sm">
        <button type="submit" class="btn btn-sm btn-warning">Search</button>
    </div>
<?php echo $form->close(); ?>

