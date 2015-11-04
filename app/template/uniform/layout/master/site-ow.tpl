<div class="sidebar-container">
    <?php echo $this->helper()->layout()->header(); ?>
</div>
<div class="main-container">
    <header id="header">
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