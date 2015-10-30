<div class="page-heading">
    <h1 class="page-title"><?php echo $post->getTitle();?></h1>
    <div class="page-note separate-cmd">
        <span>
            <?php echo $this->helper()->date($post->getCreatedAt()); ?>
        </span>
        <span>
            <?php echo $this->helper()->text('blog.$number_view', array('$number'=>$this->helper()->number($post->getViewCount())), $post->getViewCount()); ?>
        </span>
    </div>
</div>
<article class="item-detail blog-post">
    <p class="detail-desc">
        <?php echo $post->getDescription();?>
    </p>

    <div class="detail-content">
        <?php echo $post->getContent();?>
    </div>
</article>