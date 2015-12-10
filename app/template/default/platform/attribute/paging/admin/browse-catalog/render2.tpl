<?php foreach($paging->items() as $template): ?>
<div class="card-wrap card-md-12 card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <a class="profile"
               href="<?php echo $this->helper()->url('admin',[
               'stuff'=>'attribute/manage/setting','catalogId'=>$template->getId()]);?>">
                <?php echo $template->getTitle();?>
            </a>
            &middot;
            <span class="card-extra separate-cmd">
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/manage/edit', 'catalogId'=>$template->getId()]);?>">Edit</a>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/manage/setting', 'catalogId'=>$template->getId()]);?>">Setting</a>
                <a class="text-muted"
                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/manage/delete', 'catalogId'=>$template->getId()]);?>">Delete
                </a>
            </span>
            <ul>
                <?php foreach($template->getListSection() as $section): ?>
                <li>
                    <a href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/section/setting','sectionId'=>$section->getId()]);?>" class="profile">
                        <?php echo $section->getTitle(); ?>
                    </a>
                    &middot;
                    <span class="separate-cmd">
                    <a class="text-muted"
                       href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/section/edit', 'sectionId'=>$section->getId()]);?>">Edit</a>
                        <a class="text-muted"
                           href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/section/setting', 'sectionId'=>$section->getId()]);?>">Setting</a>
                        <a class="text-muted"
                           href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/section/delete', 'sectionId'=>$section->getId()]);?>">Delete
                        </a>
                    </span>
                    <ul>
                    <?php foreach($section->getListField() as $field): ?>
                        <li>
                            <a class="profile" href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/field/setting','fieldId'=>$field->getId()]);?>">
                                <?php echo $field->getTitle(); ?>
                            </a>
                            &middot;
                            <span class="separate-cmd">
                                <a class="text-muted"
                                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/field/edit', 'fieldId'=>$field->getId()]);?>">Edit
                                </a>
                                <a class="text-muted"
                                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/field/setting', 'fieldId'=>$field->getId()]);?>">Setting
                                </a>
                                <a class="text-muted"
                                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/field/delete', 'fieldId'=>$field->getId()]);?>">Delete</a>
                                <?php if($field->isPredefined()):?>
                                <a class="text-muted"
                                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/option/browse', 'fieldId'=>$field->getId()]);?>">
                                    Manage Options
                                </a>
                                                <?php endif;?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</div>
<?php endforeach; ?>