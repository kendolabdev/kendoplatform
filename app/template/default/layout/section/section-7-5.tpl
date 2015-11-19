<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section" data-render="7-5" data-template="default">
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
        <!--main-->
        <div class="col-lg-7 col-md-7 col-sm-7 location node _main" data-location="main">
            <?php echo !empty($main)?$main: '';?>
        </div>
        <!--left-->
        <div class="col-lg-5 col-md-5 col-sm-5 location node _right" data-location="right">
            <?php echo !empty($right)?$right: '';?>
        </div>

    </div>
</div>