<div class="page-heading">
    <h1 class="page-title">
        Manage Catalogs
    </h1>
    <div class="page-note">
        <a href="<?php echo $this->helper()->url('admin', ['stuff'=>'attribute/manage/create']);?>"
           class="btn btn-default">
            + Add New Catalog
        </a>
    </div>
    <div class=" page-note">
        <form class="form form-inline">
            <?php echo $filter->asList();?>
            <div class="form-group">
                <br/>
                <button type="submit" class="btn btn-warning">Search</button>
            </div>
        </form>
    </div>
</div>

<?php echo $this->forward('layout/decorator/paging-more'); ?>