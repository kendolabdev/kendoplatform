<a class="btn btn-sm btn-default"
   data-remote="ajax/message/message/compose"
   data-object='<?php _escape($attrs);?>'
   data-toggle="modal">
    <span class="ion-email-unread"></span>
    <span class="btn-txt">
        <?php echo $this->helper()->text('core.message'); ?>
    </span>
</a>