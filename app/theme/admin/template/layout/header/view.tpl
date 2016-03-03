<div class="navbar-sticky-admin">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Dashboard</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php echo \App::navigation()->render('dropdown','admin',null,[], 1 ); ?>
                <?php echo \App::navigation()->render('dropdown','admin_right',null, [], 2, ['level0'=>'nav navbar-nav
                navbar-right']); ?>
            </div>
        </div>
    </nav>
</div>