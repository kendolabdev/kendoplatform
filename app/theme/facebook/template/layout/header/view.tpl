<div class="header-container guests">
    <div class="header-topbar header-topbar-large">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <div class="site-logo-holder">
                        <a class="site-logo-link" href="<?php echo $this->helper()->url('home');?>" role="link">
                            <span class="site-logo-text"><?php echo $siteName; ?></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?php echo $this->forward('layout/header/topbar-login-form');?>
                </div>
            </div>
        </div>
    </div>
</div>