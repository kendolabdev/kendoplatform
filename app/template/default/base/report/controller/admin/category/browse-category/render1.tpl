<form method="post">
    <div class="page-heading">
        <h1 class="page-title">Manage Category</h1>

        <div class="page-note">
            <a class="btn btn-sm btn-danger"
               href="<?php echo $this->helper()->url('admin',['stuff'=>'report/category/create']);?>">
                Add new category
            </a>
        </div>
    </div>
</form>

<?php echo $this->forward('layout/decorator/paging-more');?>