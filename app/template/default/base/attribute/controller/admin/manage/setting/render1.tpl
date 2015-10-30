<div class="page-heading">
    <h1 class="page-title">
        Catalog Settings
    </h1>

    <div class="page-note">
        <div class="btn-group">
            <a href="<?php echo $this->helper()->url('admin', ['stuff'=>'attribute/manage/add-section','catalogId'=>$catalogId]);?>"
               class="btn btn-default">
                + Add existing section
            </a>
            <a href="<?php echo $this->helper()->url('admin', ['stuff'=>'attribute/section/create','catalogId'=>$catalogId]);?>"
               class="btn btn-default">
                + New section
            </a>
        </div>
    </div>
</div>

<?php if(count($listSection)): ?>
<div class="paging">
    <div class="paging-stage">
        <div class="paging-content card-space-md">
            <?php foreach($listSection as $section): ?>
            <div class="card-wrap card-md-12 card-border-bottom">
                <div class="card-stage">
                    <div class="card-content">
                        <a class="profile"
                           href="<?php echo $this->helper()->url('admin',[
               'stuff'=>'attribute/section/setting','id'=>$section->getId()]);?>">
                            <?php echo $section->getTitle();?>
                        </a>
                        &middot;
                        <span class="card-extra separate-cmd">
                            <a class="text-muted"
                               data-toggle="dismiss"
                               data-url="admin/attribute/ajax/manage/remove-section?catalogId=<?php echo $catalogId;?>"
                               data-object='<?php echo _escape($section->toTokenArray());?>'
                               role="button">Remove</a>
                            <a href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/section/setting',
                            'sectionId'=>$section->getId(),'catalogId'=> $catalogId]);?>" class="text-muted">
                                Setting
                            </a>
                        </span>
                        <ul>
                            <?php foreach($section->getListField() as $field): ?>
                            <li>
                                <a class="profile"
                                   href="<?php echo $this->helper()->url('admin',['stuff'=>'attribute/field/setting','fieldId'=>$field->getId()]);?>">
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
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php else: ?>
<p class="empty-results">
    There no sections, start by <b>Add section to this catalog</b>
</p>
<?php endif; ?>