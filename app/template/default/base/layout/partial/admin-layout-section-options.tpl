<div class="options-content">
    <ul class="options-menu">
        <!--<li data-toggle="layout-section-edit"-->
            <!--data-object='<?php echo _escape($attrs);?>'-->
            <!--data-eid="<?php echo $eid; ?>">-->
            <!--<a role="button" tabindex="-1">-->
                <!--<?php echo $this->helper()->text('core_layout.configure_section');?>-->
            <!--</a>-->
        <!--</li>-->
        <li data-toggle="layout-section-remove"
            data-object='<?php echo _escape($attrs);?>'
            data-eid="<?php echo $eid; ?>">
            <a role="button" tabindex="-1">
                <?php echo $this->helper()->text('core_layout.remove_this_section');?>
            </a>
        </li>
    </ul>
</div>