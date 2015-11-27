<?php foreach($paging->items() as $item):?>
<div class="col-md-12 card-wrap card-border-bottom">
    <div class="card-stage">
        <div class="card-content">
            <div class="card-content-stage">
                <div class="card-body">
                    <div class="card-body-stage">
                        <a class="profile" href="">
                            <?php echo $item->getTitle(); ?>
                        </a>

                        <div class="card-extra separate-cmd">
                            <a role="button"
                               data-toggle="dismiss"
                               data-closest=".card-wrap"
                               data-url="admin/report/ajax/category/delete"
                               data-object='<?php echo _escape($item->toTokenArray());?>'>
                                Delete Category
                            </a>
                            <a role="button"
                               href="<?php echo $this->helper()->url('admin',['stuff'=>'report/category/edit','id'=> $item->getId()]);?>">
                                Edit Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>