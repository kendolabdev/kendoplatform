<div class="page-heading">
    <h1 class="page-title">
        Add Field to Section
    </h1>

    <div class="page-note">
        Add more fields to sections <b><?php echo $section->getTitle();?></b>
    </div>
</div>

<?php if($paging->count()): ?>
<div class="paging">
    <div class="paging-stage">
        <div class="paging-content card-space-md">
            <?php foreach($paging->items() as $item): ?>
            <div class="card-wrap card-md-12 card-border-bottom">
                <div class="card-stage">
                    <div class="card-content">
                        <a class="profile"
                           href="<?php echo $this->helper()->url('admin',[
               'any'=>'attribute/field/setting','id'=>$item->getId()]);?>">
                            <?php echo $item->getTitle();?>
                        </a>

                        <div class="card-extra separate-cmd">
                            <a class="text-muted"
                               data-toggle="dismiss"
                               data-url="admin/attribute/ajax/section/add-field?sectionId=<?php echo $sectionId;?>"
                               data-object='<?php echo _escape($item->toTokenArray());?>'
                               role="button">Add this field</a>
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
    There no more sections
</p>
<?php endif; ?>