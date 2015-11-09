<div class="">
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
                    <?php echo \App::nav()->render('dropdown', 'main', null, [], 2, ['level0'=>'nav navbar-nav
                    navbar-right','depth' => 1,'max' => 6]); ?>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
    </div>
</div>