<?php foreach($paging->items() as $item): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'stuff'=>'attribute/field/setting','fieldId'=>$item->getId()]);?>">
                <?php echo $item->getTitle();?>
            </a>

            <div class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/field/edit', 'fieldId'=>$item->getId()]);?>">
                    Edit Field
                </a>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/field/setting', 'fieldId'=>$item->getId()]);?>">
                    Field Setting
                </a>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/field/delete', 'fieldId'=>$item->getId()]);?>">
                    Delete Field
                </a>
                <?php if($item->isPredefined()):?>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/option/browse', 'fieldId'=>$item->getId()]);?>">
                    Manage Option
                </a>
                <?php endif;?>
            </div>
        </div>

    </div>
</div>
<?php endforeach; ?>