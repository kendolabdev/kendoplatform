<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'any'=>'help/topic/browse','category'=>$item->getId()]);?>"><?php echo $item->getTitle(); ?></a>

            <div class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['any'=>'help/category/edit', 'id'=>$item->getId()]);?>">Edit Category</a>

                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['any'=>'help/category/delete', 'id'=>$item->getId()]);?>">Delete Category</a>
            </div>

        </div>
    </div>
</div>
<?php endforeach; ?>