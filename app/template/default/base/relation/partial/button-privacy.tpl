<div class="btn-group">
    <a class="btn <?php echo $sizeClass?> btn-default dropdown-toggle"
       data-toggle="options"
       data-remote="ajax/relation/privacy/options"
       data-for="for-btn"
       data-object='<?php echo $attrs; ?>'>
    <span class="text">
        <?php echo $privacy['label'];?>
    </span>
        <span class="caret"></span>
        <input type="hidden" class="privacy-type" name="<?php echo $name;?>[type]"
               value="<?php echo $privacy['type'];?>"/>
        <input type="hidden" class="privacy-value" name="<?php echo $name;?>[value]"
               value="<?php echo $privacy['value']; ?>"/>
    </a>
</div>