<div id="<?php echo $fullControllerName;?>">
    <header id="header">
        <?php echo $this->helper()->layout()->header(); ?>
    </header>
    <div id="main">
        <?php echo app()->layouts()->content(); ?>
    </div>
    <footer id="footer">
        <?php echo $this->helper()->layout()->footer(); ?>
    </footer>
</div>
<?php echo app()->assetService()->requirejs()->renderScriptHtml(); ?>