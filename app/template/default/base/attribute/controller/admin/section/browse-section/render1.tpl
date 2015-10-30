<div class="page-heading">
    <h1 class="page-title">
        Manage Sections
    </h1>

    <div class="page-note">
        <a href="<?php echo $this->helper()->url('admin', ['stuff'=>'attribute/section/create']);?>"
           class="btn btn-warning">
            Add New Section
        </a>
    </div>
    <div class="page-note">
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