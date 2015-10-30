<div class="options-content">
    <div class="options-header">
        <div class="options-note">
            <?php echo $note; ?>
        </div>
    </div>
    <ul class="options-menu">
        <?php foreach($options as $option): ?>
        <li data-toggle="btn-edit-option-privacy"
            data-privacy='<?php echo _escape(json_encode($option));?>'
            data-object='<?php echo _escape($about->toTokenArray());?>'
            data-eid="<?php echo $eid;?>">
            <a role="button"><?php echo $option['label'];?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

