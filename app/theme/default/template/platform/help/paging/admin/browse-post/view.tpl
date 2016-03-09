<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'any'=>'help/manage/edit','id'=>$item->getId()]);?>"><?php echo $item->getTitle(); ?></a>

            <div class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['any'=>'help/manage/edit', 'id'=>$item->getId()]);?>">Edit Post</a>

                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['any'=>'help/manage/delete', 'id'=>$item->getId()]);?>">Delete Post</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>