<div class="page-heading">
    <h1 class="page-title">Abuse Reports</h1>

    <div class="page-note">
        <a class="btn btn-sm btn-danger" href="?delete=all">
            Delete All Reports
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
<?php echo $this->forward('layout/decorator/paging-more');?>
