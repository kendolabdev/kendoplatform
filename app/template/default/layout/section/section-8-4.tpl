<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section section-main" data-render="8-4" data-template="default">
    <?php if(!empty($forEdit)): ?>
    <div class="section-header">
        <div class="btn-group options pull-right">
            <a role="button" class="right" data-toggle="options" data-remote="admin/layout/ajax/editor/section-options">
                <i class="ion-ios-arrow-down"></i>
            </a>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 location node _main" data-location="main">
            <?php echo !empty($main)?$main: '';?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 location node _right" data-location="right">
            <?php echo !empty($right)?$right: '';?>
        </div>
    </div>
</div>