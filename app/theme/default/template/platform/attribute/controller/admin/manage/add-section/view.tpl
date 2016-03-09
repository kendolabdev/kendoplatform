<div class="page-heading">
    <h1 class="page-title">
        Add Sections
    </h1>

    <div class="page-note">
        Add new section to catalog <b><?php echo $catalog->getTitle();?></b>
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
               'any'=>'attribute/section/setting','id'=>$item->getId()]);?>">
                            <?php echo $item->getTitle();?>
                        </a>

                        <div class="card-extra separate-cmd">
                            <a class="text-muted"
                               data-toggle="dismiss"
                               data-url="admin/attribute/ajax/manage/add-section?catalogId=<?php echo $catalogId;?>"
                               data-object='<?php echo _escape($item->toTokenArray());?>'
                               role="button">Add
                                This Section</a>
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