<div class="">
    <div class="navbar-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <ul class="list-flex">
                        <li>
                            <a role="button" target="_blank" href="<?php echo $contact['facebook'];?>" >
                                <i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a role="button" target="_blank" href="<?php echo $contact['twitter'];?>">
                                <i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a role="button" target="_blank" href="<?php echo $contact['google'];?>">
                                <i class="fa fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a role="button" target="_blank" href="<?php echo $contact['pinterest'];?>">
                                <i class="fa fa-pinterest"></i></a>
                        </li>
                        <li>
                            <a role="button" target="_blank" href="<?php echo $contact['youtube'];?>">
                                <i class="fa fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="text-right">
                        <ul class="list-flex right">
                            <li>
                                <a role="button" href="<?php echo $this->helper()->url('login');?>">
                                    <i class="fa fa-lock"></i>
                                    Login
                                </a>
                            </li>
                            <li>
                                <a role="button" href="<?php echo $this->helper()->url('register');?>">
                                    <i class="fa fa-user"></i>
                                    Sign Up
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="navbar-rocky hidden-xs">-->
        <!--<div class="container">-->
            <!--<div class="row">-->
                <!--<div class="col-md-4">-->
                    <!--<h1>YouNet</h1>-->
                <!--</div>-->
                <!--<div class="col-md-4">-->

                <!--</div>-->
                <!--<div class="col-md-4">-->

                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
    <div class="navbar-sticky">
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand text-uppercase visible-xs" href="<?php echo $this->helper()->url('home');?>">YouNet</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-right" action="<?php echo $searchUrl;?>">
                        <div class="form-group form-group-sm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" value="<?php echo $q;?>" name="q" />
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default btn-search" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php echo \App::nav()->render('dropdown', 'main', null, [], 2, ['level0'=>'nav navbar-nav
                    navbar-right','depth' => 1,'max' => 6]); ?>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
    </div>
</div>