<div class="page-heading">
    <div class="page-title">
        Manage Albums
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