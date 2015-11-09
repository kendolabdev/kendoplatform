<div class="header-container guests">
    <div class="header-topbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6 hidden-xs">
                    <div class="site-logo-holder">
                        <a class="site-logo-link" href="<?php echo $this->helper()->url('home');?>" role="link">
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
</div>