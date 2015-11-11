<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section" data-render="3.9" data-template="default">
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
        <div class="col-lg-12 col-md-12 location node _top" data-location="top">
            <?php echo !empty($top)?$top: '';?>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 location node _left" data-location="left">
            <?php echo !empty($left)?$left: '';?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 location node _main" data-location="main">
            <?php echo !empty($main)?$main: '';?>
        </div>
        <div class="col-lg-12 col-md-12 location node _bottom" data-location="bottom">
            <?php echo !empty($bottom)?$bottom: '';?>
        </div>
    </div>
</div>