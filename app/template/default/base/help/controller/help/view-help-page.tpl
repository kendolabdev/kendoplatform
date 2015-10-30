<div class="page-heading">
    <h1 class="page-title">
        <?php echo $page->getTitle(); ?>
    </h1>
</div>

<div class="page-content">
    <?php echo $page->getContent(); ?>
</div>

<div>
    <?php echo $this->helper()->text('core.last_update'); ?>: <?php echo $this->helper()->date($page->getUpdatedAt());
    ?>
</div>