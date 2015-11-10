<form method="post" action="<?php echo $this->helper()->url('login');?>"
      class="form-inline header-login-form">
    <div class="form-group">
        <label for="_email"><?php echo $this->helper()->text('core.email');?></label>
        <input tabindex="1" id="_email" type="text" name="email" class="form-control"
               placeholder="Login ID"/>

        <div class="header-login-fp">
            <a role="button" tabindex="5" class="dead-link"
               href="<?php echo $this->helper()->url('forgot_password');?>"><?php echo $this->helper()->text('core.forgot_password?');?></a>
        </div>
    </div>
    <div class="form-group">
        <label for="_email"><?php echo $this->helper()->text('core.password');?></label>
        <input tabindex="2" id="_password" type="password" name="password" class="form-control"
               placeholder="<?php echo $this->helper()->text('core.password');?>"/>

        <div class="header-login-fp">
            <label class="dead-link">
                <input tabindex="3" type="checkbox" name="remember" value="1"/> <?php echo $this->helper()->text('core.remember_me');?>
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