<div class="">
    <div class="header-topbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <?php echo $this->forward('layout/header/topbar-social-menu');?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="text-right">
                        <a role="button" href="<?php echo $this->helper()->url('login');?>" class="btn btn-sm">
                            Login
                            <i class="fa fa-sign-in"></i>
                        </a>
                        <a role="button" href="<?php echo $this->helper()->url('register');?>" class="btn btn-sm">
                            Sign Up
                            <i class="fa fa-user"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-navbar">
        <nav class="navbar">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $this->helper()->url('home');?>">YouNet</a>
                </div>
                <?php echo app()->navigation()->render('dropdown', 'main', null, [], 2, ['level0'=>'nav navbar-nav
                navbar-right','depth' => 1,'max' => 6]); ?>
            </div>
            <!-- /.navbar-collapse -->
    </div>
    </nav>
</div>
</div>