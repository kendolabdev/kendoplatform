<div class="page-heading">
    <h1 class="page-title">
        Manage Members
    </h1>
</div>
<div class="page-search-bar">
    <form class="form form-inline">
        <?php echo $filter->asList();?>
        <div class="form-group">
            <br />
            <button type="submit" class="btn btn-warning">Search</button>
        </div>
    </form>
</div>
<?php echo $this->forward('layout/decorator/paging-more'); ?>