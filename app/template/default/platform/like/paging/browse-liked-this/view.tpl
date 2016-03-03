<?php foreach($paging->items() as $like): ?>
<?php $poster  = $like->getPoster(); ?>
<div class="poster-item">
    <a class="poster-photo" href="<?php echo $poster->toHref();?>">
        <img class="poster-img" src="<?php echo $poster->getPhoto('avatar_lg'); ?>"/>
    </a>

    <div class="poster-info">
        <a class="profile poster-title" href="<?php echo $poster->toHref(); ?>">
            <?php echo $poster->getTitle();?>
        </a>
    </div>
</div>
<?php endforeach; ?>