<div id="<?php echo $fullControllerName;?>">
    <header id="header">
        <?php echo $this->helper()->layout()->header(); ?>
    </header>
    <div id="main">
        <?php echo \App::layout()->content(); ?>
    </div>
    <footer id="footer">
        <?php echo $this->helper()->layout()->footer(); ?>
    </footer>
</div>
<?php echo \App::assets()->requirejs()->renderScriptHtml(); ?>