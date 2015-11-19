<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section" data-render="4-8" data-template="default">
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
        <div class="col-lg-4 col-md-4 col-sm-4 location node _left" data-location="left">
            <?php echo !empty($left)?$left: '';?>
        </div>
        <!--left-->
        <div class="col-lg-8 col-md-8 col-sm-8 location node _main" data-location="main">
            <?php echo !empty($main)?$main: '';?>

        </div>

    </div>
</div>