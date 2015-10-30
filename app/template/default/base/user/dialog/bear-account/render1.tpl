<div class="options-content">
    <ul class="beeber-menu">
        <li>
            <a href="<?php echo $this->helper()->url('admin');?>" data-toggle="1">
                <?php echo $this->helper()->text('core.access_admin');?>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="<?php echo $this->helper()->url('edit_profile');?>" data-toggle="1">
                <?php echo $this->helper()->text('core.edit_profile');?>
            </a>
        </li>
        <li>
            <a href="<?php echo $this->helper()->url('user_settings');?>" data-toggle="1">
                <?php echo $this->helper()->text('core.settings');?>
            </a>
        </li>
        <li>
            <a href="<?php echo $this->helper()->url('logout');?>" data-toggle="1">
                <?php echo $this->helper()->text('core.logout');?>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="<?php echo $this->helper()->url('help',[]);?>" data-toggle="1">
                <?php echo $this->helper()->text('core.help');?>
            </a>
            <a role="button" data-toggle="btn-report">
                <?php echo $this->helper()->text('core.report_a_problem');?>
            </a>
        </li>
    </ul>
</div>