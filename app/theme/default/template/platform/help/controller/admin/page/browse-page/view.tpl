<div class="page-heading">
    <h1 class="page-title">Manage Pages</h1>
    <div class="page-note">
        <a class="btn btn-default" href="<?php echo $this->helper()->url('admin',['any'=>'help/page/create']);?>">
            Add New Page
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

<?php echo $this->forward('layout/facade/paging-more/view');?>