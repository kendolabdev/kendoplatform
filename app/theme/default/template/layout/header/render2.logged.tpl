<div class="">
    <div class="header-topbar">
        <div class="container-fluid">
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
                        <?php echo $this->forward('layout/header/menu-user');?>
                        <form method="get" class="form-inline pull-right" action="<?php echo $searchUrl;?>">
                            <div class="form-group form-group-sm has-feedback">
                                <input type="text" class="form-control" value="<?php echo $q;?>" name="q" />
                                <span class="form-control-feedback">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                            <button type="submit" class="hidden" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-navbar">
        <nav class="navbar navbar-default">
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

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php echo \App::nav()->render('dropdown', 'main', null, [], 2, ['level0'=>'nav navbar-nav navbar-right','depth' => 1,'max' => 6]); ?>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
    </div>
</div>