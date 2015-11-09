<div class="">
    <div class="header-topbar">
        <div class="container-fluid">
            <div class="col-lg-4 col-md-4 col-sm-4">

            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <form method="get" class="form-search" action="<?php echo $searchUrl;?>">
                    <div class="form-group form-group-sm has-feedback">
                        <input type="text" class="form-control" value="<?php echo $q;?>" name="q" />
                        <span class="form-control-feedback">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <button type="submit" class="hidden" />
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <ul class="list-flex right logged">
                    <li class="beeber">
                        <?php echo $this->helper()->btnBearAccount(); ?>
                    </li>
                    <li class="beeber">
                        <?php echo $this->helper()->btnBearMessage(); ?>
                    </li>
                    <li class="beeber">
                        <?php echo $this->helper()->btnBearInvitation(); ?>
                    </li>
                    <li class="beeber">
                        <?php echo $this->helper()->btnBearNotification(); ?>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo $this->helper()->url('home');?>">Home</a>
                    </li>
                    <li class="viewer">
                        <?php echo $this->helper()->btnTopbarViewer();?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>