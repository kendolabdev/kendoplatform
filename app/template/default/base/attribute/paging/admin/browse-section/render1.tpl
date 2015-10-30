<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'stuff'=>'attribute/section/setting','sectionId'=>$item->getId()]);?>">
                <?php echo $item->getTitle();?>
            </a>

            <div class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/section/edit', 'sectionId'=>$item->getId()]);?>">Edit</a>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/section/setting', 'sectionId'=>$item->getId()]);?>">Setting</a>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/section/delete', 'sectionId'=>$item->getId()]);?>">Delete
                </a>
            </div>
        </div>

    </div>
</div>
<?php endforeach; ?>