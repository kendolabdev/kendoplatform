<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'any'=>'help/manage/browse','topic'=>$item->getId()]);?>"><?php echo $item->getTitle(); ?></a>

            <div class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['any'=>'help/topic/edit', 'id'=>$item->getId()]);?>">Edit
                    Topic</a>

                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['any'=>'help/topic/delete', 'id'=>$item->getId()]);?>">Delete
                    Topic</a>
            </div>
        </div>

    </div>
</div>
<?php endforeach; ?>