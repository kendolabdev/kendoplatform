<form method="get" class="header-search-form" action="<?php echo $searchUrl;?>">
    <div class="form-group has-feedback">
        <input type="text" class="form-control" value="<?php echo $q;?>" name="q"/>
                                <span class="form-control-feedback">
                                    <i class="fa fa-search"></i>
                                </span>
    </div>
    <input type="submit" class="hidden"/>
</form>