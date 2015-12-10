<div class="page-heading">
    <h1 class="page-title">
        Section Settings
    </h1>

    <div class="page-note">
        <a href="<?php echo $this->helper()->url('admin', ['stuff'=>'attribute/section/add-field','sectionId'=>$sectionId]);?>"
           class="btn btn-warning">
            Add field to this section
        </a>
    </div>
</div>

<?php if(count($listField)): ?>
<div class="paging">
    <div class="paging-stage">
        <div class="paging-content card-space-md">
            <?php foreach($listField as $item): ?>
            <div class="card-wrap card-md-12 card-border-bottom">
                <div class="card-stage">
                    <div class="card-content">
                        <a class="profile"
                           href="<?php echo $this->helper()->url('admin',[
               'stuff'=>'attribute/field/setting','id'=>$item->getId()]);?>">
                            <?php echo $item->getTitle();?>
                        </a>

                        <div class="card-extra separate-cmd">
                            <a class="text-muted"
                               data-toggle="dismiss"
                               data-url="admin/attribute/ajax/manage/remove-section?sectionId=<?php echo $sectionId;?>"
                               data-object='<?php echo _escape($item->toTokenArray());?>'
                               role="button">Remove this field</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php else: ?>
<p class="empty-results">
    There no fields, start by <b>Add field to this section</b>
</p>
<?php endif; ?>