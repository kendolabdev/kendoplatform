<?php if($isContainer): ?>
<div class="options-content">
    <ul class="options-menu">
        <li data-toggle="layout-block-edit" data-object='<?php echo _escape($attrs);?>'>
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('core_layout.container_settings');?>
            </a>
        </li>
        <li data-toggle="layout-block-remove" data-object='<?php echo _escape($attrs);?>'>
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('core_layout.remove_this_container');?>
            </a>
        </li>
    </ul>
</div>
<?php else: ?>
<div class="options-content">
    <ul class="options-menu">
        <li data-toggle="layout-block-edit" data-object='<?php echo _escape($attrs);?>'>
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('core_layout.content_settings');?>
            </a>
        </li>
        <li data-toggle="layout-block-remove" data-object='<?php echo _escape($attrs);?>'>
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('core_layout.remove_this_block');?>
            </a>
        </li>
    </ul>
</div>
<?php endif; ?>
