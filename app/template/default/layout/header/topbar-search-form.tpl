<form method="get" class="form-inline header-search-form" action="<?php echo $searchUrl;?>">
    <div class="form-group form-group-sm has-feedback">
        <input type="text" class="form-control" value="<?php echo $q;?>" name="q"/>
                                <span class="form-control-feedback">
                                    <i class="fa fa-search"></i>
                                </span>
    </div>
    <input type="submit" class="hidden"/>
</form>