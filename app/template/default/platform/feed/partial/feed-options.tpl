<div class="options-content">
    <ul class="options-menu">
        <?php if($canEditPost): ?>
        <li role="presentation"
            data-toggle="feed-edit"
            data-object='<?php echo $jsonContext;?>'>
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('activity.edit_post');?>
            </a>
        </li>
        <?php endif; ?>

        <?php if($canEditPost): ?>
        <li role="presentation"
            data-toggle="feed-open-privacy"
            data-object='<?php echo $jsonContext;?>'>
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('activity.change_privacy');?>
            </a>
        </li>
        <?php endif; ?>

        <?php if($canHide): ?>
        <li role="presentation"
            data-toggle="feed-hide"
            data-object='<?php echo $jsonContext;?>'>
            <?php if($hidden): ?>
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('core.i_want_to_see_this'); ?>
            </a>
            <?php else: ?>
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('core.i_don_want_to_see_this'); ?>
            </a>
            <?php endif; ?>
        </li>
        <?php endif; ?>

        <?php if($canFollow): ?>
        <li role="presentation"
            data-toggle="link-toggle-follow"
            data-object='<?php echo $jsonContext;?>'>
            <a role="button" tabindex="-1">
                <?php echo $followLabel; ?>
            </a>
        </li>
        <?php endif; ?>

        <?php if($canEmbed): ?>
        <li role="presentation">
            <a role="button" tabindex="-1">Embed this post</a>
        </li>
        <?php endif; ?>

        <?php if($canSave): ?>
        <li role="presentation">
            <a role="button" tabindex="-1">
                <?php echo $saveThisLabel; ?>
            </a>
        </li>
        <?php endif; ?>

        <?php if($canSubscribe): ?>
        <li role="presentation"
            data-toggle="feed-subscribe"
            data-object='<?php echo $jsonContext;?>'>
            <?php if($subscribed): ?>
            <a role="button" tabindex="-1"><?php echo $this->helper()->text('activity.turn_off_notification');?></a>
            <?php else: ?>
            <a role="button" tabindex="-1"><?php echo $this->helper()->text('activity.turn_on_notification');?></a>
            <?php endif;?>
        </li>
        <?php endif; ?>


        <li class="divider"></li>

        <?php if($canHideTimeline): ?>
        <li role="presentation"
            data-toggle="feed-hide-timeline"
            data-object='<?php echo $jsonContext;?>'>
            <a role="button" tabindex="-1"><?php echo $this->helper()->text('activity.hide_from_timeline');?></a>
        </li>
        <?php endif; ?>

        <?php if($canReport): ?>
        <li role="presentation" data-toggle="btn-report" data-object='<?php echo $jsonContext;?>'>
            <a role="button" tabindex="-1"><?php echo $this->helper()->text('core.report_about_this_post');?></a>
        </li>
        <?php endif; ?>

        <?php if($canDelete): ?>
        <li role="presentation" data-toggle="feed-remove" data-object='<?php echo $jsonContext;?>'>
            <a role="button" tabindex="-1"><?php echo $this->helper()->text('core.delete');?></a>
        </li>
        <?php endif; ?>
    </ul>
</div>