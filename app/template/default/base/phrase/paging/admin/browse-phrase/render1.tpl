<?php foreach($paging->items() as $item):
$id = $item->getPhraseId(); ?>
<div class="form-group">
    <label for="_txt"><?php echo $item->getKey(); ?></label>
    <p class="help-block"><?php echo $item->getDefaultValue(); ?></p>
        <textarea id="_txt" name="translation[<?php echo $langId; ?>][<?php echo $id; ?>]" class="form-control"
                  rows="2"><?php echo $item->__get('phrase_value');?></textarea>
</div>
<?php endforeach; ?>