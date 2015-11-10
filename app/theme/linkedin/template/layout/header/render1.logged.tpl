<div class="header-container members">
    <div class="header-topbar header-topbar-base">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-4 hidden-xs">
                    <div class="site-logo-holder">
                        <a class="site-logo-link" href="<?php echo $this->helper()->url('home');?>">
                            <span class="site-logo-text"><?php echo $siteName; ?></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 hidden-xs">
                    <?php echo $this->forward('layout/header/topbar-search-form');?>
                </div>

                <div class="col-md-5 col-sm-4">
                    <?php echo $this->forward('layout/header/topbar-user-menu');?>
                </div>
            </div>
        </div>
    </div>

    <div class="header-navbar">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="row">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand visible-xs" href="<?php echo $this->helper()->url('home');?>">YouNet</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php echo \App::nav()->render('dropdown', 'main', null, [], 2, ['level0'=>'nav
                        navbar-nav','depth' => 1,'max' => 6]); ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>