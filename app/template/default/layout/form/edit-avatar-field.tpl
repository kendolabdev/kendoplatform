<div class="field-avatar-ow">
    <div class="field-avatar-iw">
        <img class="field-preview-img"
             src="<?php echo $photoUrl;?>"
             width="<?php echo $width;?>"
             height="<?php echo $height;?>"
             style="<?php echo $style;?>"
             id="<?php echo $previewImgId; ?>"/>
    </div>
    <div class="cmd-bar">
        <a role="button"
           data-toggle="field-avatar-upload"
           data-target="#<?php echo $fileInputId;?>">
            <?php echo $this->helper()->text('Upload Avatar');?>
        </a>
    </div>
    <input
            id="<?php echo $fileHiddenId;?>"
            name="<?php echo $name; ?>"
            type="hidden"
            class="hidden avatar-value"
            value='<?php echo $value; ?>'
            data-opts='<?php echo json_encode($opts);?>'/>

    <input type="file"
           id="<?php echo $fileInputId;?>"
           class="hidden"
           accept="image/*"/>
</div>