<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'stuff'=>'attribute/manage/setting','catalogId'=>$item->getId()]);?>">
                <?php echo $item->getTitle();?>
            </a> -  for <b><?php echo $item->getContentId(); ?></b>

            <div class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/manage/edit', 'catalogId'=>$item->getId()]);?>">Edit
                    Information</a>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/manage/setting', 'catalogId'=>$item->getId()]);?>">Edit
                    Setting</a>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/manage/delete', 'catalogId'=>$item->getId()]);?>">Delete
                    Catalog
                </a>
            </div>
        </div>

    </div>
</div>
<?php endforeach; ?>