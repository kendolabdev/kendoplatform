<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'any'=>'help/manage/edit','id'=>$item->getId()]);?>"><?php echo $item->getTitle(); ?></a>

            <div class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['any'=>'help/page/edit', 'id'=>$item->getId()]);?>">Edit Page</a>

                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['any'=>'help/page/delete', 'id'=>$item->getId()]);?>">Delete Page</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>