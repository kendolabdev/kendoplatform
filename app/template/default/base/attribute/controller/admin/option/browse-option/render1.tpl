<div class="page-heading">
    <div class="page-note">
        <a href="<?php echo $this->helper()->url('admin', ['stuff'=>'attribute/option/create','fieldId'=>$fieldId]);?>"
           class="btn btn-warning">
            Add New Option
        </a>
    </div>
</div>

<?php echo $this->forward('layout/decorator/paging-more'); ?>