<div class="footer-layout1">
    <!--Copyright-->
    <div class="footer-legas">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    &copy; <?php echo date('Y'); ?>  <?php echo $this->helper()->text('core.copyright_label');?>
                </div>
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <ul class="pull-right nomargin list-inline mobile-block">
                        <li><a data-toggle="1" href="<?php echo $this->helper()->url('help_page',['page'=>'terms']);?>">
                            <?php echo $this->helper()->text('core.terms_of_service');?></a></li>
                        <li>•</li>
                        <li><a href="<?php echo $this->helper()->url('help_page',['page'=>'privacy']);?>"
                               data-toggle="1">
                            <?php echo $this->helper()->text('core.privacy');?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>