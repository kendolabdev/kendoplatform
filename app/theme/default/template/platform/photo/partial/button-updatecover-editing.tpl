<div class="btn-group for-editing">
    <button class="btn btn-sm btn-default" data-toggle="tl-cover-save"
            data-object='<?php echo json_encode($dataSubject);?>'>
        <a role="button">
            <?php echo $this->helper()->text('core.save');?>
        </a>
    </button>
    <button class="btn btn-sm btn-default" data-toggle="tl-cover-cancel">
        <a role="button">
            <?php echo $this->helper()->text('core.cancel');?>
        </a>
    </button>
</div>