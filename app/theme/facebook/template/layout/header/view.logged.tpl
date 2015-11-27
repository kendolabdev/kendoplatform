<div class="header-container members">
    <div class="header-topbar header-topbar-base">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3 hidden-xs">
                    <div class="site-logo-holder">
                        <a class="site-logo-link" href="<?php echo $this->helper()->url('home');?>" role="link">
                            <span class="site-logo-text"><?php echo $siteName; ?></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 hidden-xs">
                    <?php echo $this->forward('layout/header/topbar-search-form');?>
                </div>
                <div class="col-lg-6 col-md-6">
                    <?php echo $this->forward('layout/header/topbar-user-menu');?>
                </div>
            </div>
        </div>
    </div>
    <div class="header-fix-top"></div>
</div>