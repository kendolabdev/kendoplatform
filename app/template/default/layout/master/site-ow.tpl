<div id="<?php echo $fullControllerName;?>">
    <header id="header">
        <?php echo $this->helper()->layout()->header(); ?>
    </header>
    <section id="main">
        <div class="container-fluid">
            <?php echo \App::layout()->content(); ?>
        </div>
    </section>
    <footer id="footer">
        <?php echo $this->helper()->layout()->footer(); ?>
    </footer>
</div>
<?php echo \App::assets()->requirejs()->renderScriptHtml(); ?>