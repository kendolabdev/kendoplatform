<a role="button" tabindex="-1">
    <?php if($following): ?>
    <a role="button">
        <i class="ion-checkmark"></i>
        <?php echo $this->helper()->text('core.following');?>
    </a>
    <?php else: ?>
    <a role="button">
        <i class="ion-social-rss"></i>
        <?php echo $this->helper()->text('core.follow');?>
    </a>
    <?php endif; ?>
</a>