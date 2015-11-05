<div class="">
    <div class="header-topbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <div class="site-logo-holder">
                        <a class="site-logo-link" href="<?php echo $this->helper()->url('home');?>">
                            <span class="site-logo-text">YouNet</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <form method="post" action="<?php echo $this->helper()->url('login');?>"
                          class="form-inline header-login">
                        <div class="form-group">
                            <label for="_email">Email</label>
                            <input tabindex="1" id="_email" type="text" name="email" class="form-control"
                                   placeholder="Login ID"/>

                            <div class="header-login-fp">
                                <a role="button" tabindex="5" class="link-label"
                                   href="<?php echo $this->helper()->url('forgot_password');?>">Forgot password?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="_password">Password</label>
                            <input tabindex="2" id="_password" type="password" name="password" class="form-control"
                                   placeholder="password"/>

                            <div class="header-login-fp">
                                <label>
                                    <input tabindex="3" type="checkbox" name="remember" value="1"/> Keep me login
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="_submit">&nbsp;</label>
                            <button tabindex="4" type="submit" id="_submit" class="btn btn-danger"><i
                                    class="fa fa-sign-in"></i></button>
                            <div class="header-login-fp">
                                <label>
                                    &nbsp;
                                </label>
                            </div>
                        </div>
                    </form>
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
                        <button type="button" class="navbar-btn visible-xs pull-right">
                            <i class="ion-ios-search"></i>
                        </button>
                        <a class="navbar-brand visible-xs" href="<?php echo $this->helper()->url('home');?>">YouNet</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php echo \App::nav()->render('dropdown', 'main',null, [], 2, ['level0'=>'nav
                        navbar-nav','depth' => 1,'max' => 6]); ?>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </div>
        </nav>
    </div>
</div>