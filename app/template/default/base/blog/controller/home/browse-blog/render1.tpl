<div class="page-heading">
    <h1 class="page-title"><?php echo $this->helper()->text('blog.blogs');?>
        <div class="pull-right">
            <div class="btn-group">
                <a role="button" data-toggle="dropdown" data-remote="">
                    <i class="ion-android-more-horizontal"></i>
                </a>
            </div>
        </div>
    </h1>
</div>

<?php echo $this->forward('layout/decorator/paging-more'); ?>