<div class="options-content">
    <ul class="options-menu">
        <li role="presentation" data-toggle="comment-edit" data-object='<?php echo _escape($cmt->toTokenArray()); ?>'
            data-eid="<?php echo $eid;?>">
            <a role="button" tabindex="-1"><?php echo $this->helper()->text('activity.edit_comment');?></a>
        </li>
        <li role="presentation" data-toggle="comment-remove" data-object='<?php echo _escape($cmt->toTokenArray()); ?>'
            data-eid="<?php echo $eid;?>">
            <a role="button" tabindex="-1"><?php echo $this->helper()->text('activity.delete_comment');?></a>
        </li>
        <li role="presentation" data-toggle="btn-report" data-object='<?php echo _escape($cmt->toTokenArray()); ?>'
            data-eid="<?php echo $eid;?>">
            <a role="button" tabindex="-1"><?php echo $this->helper()->text('core.report');?></a>
        </li>
    </ul>
</div>