<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('help',[
               'stuff'=>'help/topic/browse','category'=>$item->getId()]);?>"><?php echo $item->getTitle(); ?></a>
            <?php foreach($item->getSamplePost() as $child):?>
            <p>
                <a href="<?php echo $child->toHref();?>"><?php echo $child->getTitle();?></a>
            </p>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>