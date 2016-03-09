<?php foreach($paging->items() as $item): ?>
    <div class="blog-item">
        <h5><a href="<?php echo $item->toHref([]); ?>"><?php echo $item->getTitle(); ?></a></h5>
        <div class="separate-cmd">
            <span>
                <a class="profile" href="<?php echo $item->getPoster()->toHref();?>"><?php echo $item->getPoster()->getTitle();?></a>
            </span>
            <span>
                <?php echo $this->helper()->date($item->getCreatedAt());?>
            </span>
        </div>
    </div>
<?php endforeach; ?>