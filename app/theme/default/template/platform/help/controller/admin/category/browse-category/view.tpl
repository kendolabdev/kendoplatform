<div class="page-heading">
    <h1 class="page-title">Manage Categories</h1>
    <div class="page-note">
        <a class="btn btn-default" href="<?php echo $this->helper()->url('admin',['any'=>'help/category/create']);?>">
            Add New Category
        </a>
    </div>
</div>

<?php echo $this->forward('layout/facade/paging-more/view');?>