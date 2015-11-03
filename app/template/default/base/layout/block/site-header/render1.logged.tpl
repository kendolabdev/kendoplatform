<div class="">
    <div class="navbar-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-4 hidden-xs">
                    <div class="site-logo-holder">
                        <a class="site-logo-link" href="<?php echo $this->helper()->url('home');?>">
                            <span class="site-logo-text">YouNet</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 hidden-xs">
                    <form class="header-search-form" action="<?php echo $searchUrl;?>">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Search" value="<?php echo $q;?>" name="q" />
                            <div class="form-control-feedback">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-5 col-sm-4">
                    <div class="text-right header-menu-right">
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
                            <li class="viewer">
                                <?php echo $this->helper()->btnTopbarViewer();?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar-sticky">
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
                        <?php echo \App::nav()->render('dropdown', 'main', null, [], 2, ['level0'=>'nav navbar-nav','depth' => 1,'max' => 6]); ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>