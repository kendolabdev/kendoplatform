<div class="options-content">
    <div class="options-header">
        <div class="options-note">
            <?php echo $note; ?>
        </div>
    </div>
    <ul class="options-menu">
        <?php foreach($options as $option): ?>
        <li data-toggle="btn-option-privacy"
            data-privacy='<?php echo _escape(json_encode($option));?>'
            data-eid="<?php echo $eid;?>">
            <a role="button"><?php echo $option['label'];?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

