<?php if($subscribed): ?>
<a role="button" tabindex="-1"><?php echo $this->helper()->text('activity.turn_off_notification');?></a>
<?php else: ?>
<a role="button" tabindex="-1"><?php echo $this->helper()->text('activity.turn_on_notification');?></a>
<?php endif;?>