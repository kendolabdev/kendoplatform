<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo \App::assets()->header(); ?>
    <?php echo \App::assets()->headCode(); ?>
</head>
<body>
<div id="site-wrap">
    <div id="site-container">
        <header id="header">
            <?php echo $this->helper()->layout()->header(); ?>
        </header>
        <section id="main">
            <div class="container">
                <?php echo \App::layout()->content(); ?>
            </div>
        </section>
        <footer id="footer">
            <?php echo $this->helper()->layout()->footer(); ?>
        </footer>
    </div>
</div>
<section id="docklet-ow">
    <!--chat list-->
</section>
<a role="button" id="scrolltop" class="fade" ride="scrollToTop"></a>
<input type="hidden" id="dirty" value="0"/>
<?php echo \App::assets()->footer(); ?>
<?php echo \App::assets()->requirejs(); ?>
<?php echo \App::assets()->bottomCode(); ?>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>-->
</body>
</html>