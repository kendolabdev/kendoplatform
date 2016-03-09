<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo app()->assetService()->header(); ?>
    <?php echo app()->assetService()->headCode(); ?>
</head>
<body>
<div id="site-wrap">
    <div id="site-container">
        <div id="<?php echo $fullControllerName;?>">
            <header id="header">
                <?php echo app()->layouts()->header(); ?>
            </header>
            <div id="main">
                <?php echo app()->layouts()->content(); ?>
            </div>
            <footer id="footer">
                <?php echo app()->layouts()->footer(); ?>
            </footer>
        </div>
    </div>
</div>
<section id="docklet-ow">
    <!--chat list-->
</section>
<a role="button" id="scrolltop" class="fade" ride="scrollToTop"></a>
<input type="hidden" id="dirty" value="0"/>
<?php echo app()->assetService()->footer(); ?>
<?php echo app()->assetService()->requirejs(); ?>
<?php echo app()->assetService()->bottomCode(); ?>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>-->
</body>
</html>