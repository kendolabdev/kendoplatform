<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'stuff'=>'attribute/option/browse','catalog'=>$item->getId()]);?>">
                <?php echo $item->getTitle();?>
            </a>

            <div class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/option/edit', 'id'=>$item->getId()]);?>">
                    Edit Option
                </a>

                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/option/delete', 'id'=>$item->getId()]);?>">
                    Delete Option
                </a>
            </div>
        </div>

    </div>
</div>
<?php endforeach; ?>