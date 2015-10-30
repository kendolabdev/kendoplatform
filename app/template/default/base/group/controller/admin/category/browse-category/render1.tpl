<div class="page-heading">
    <h1 class="page-title">
        Manage Categories
    </h1>

    <div class="page-note">
        <a href="<?php echo $this->helper()->url('admin', ['stuff'=>'group/category/create']);?>"
           class="btn btn-warning">
            Add New Category
        </a>
    </div>
</div>

<?php echo $this->forward('layout/decorator/paging-more'); ?>