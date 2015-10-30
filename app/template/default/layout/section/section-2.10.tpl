<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section" data-render="2.10" data-template="default">
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
        <!--left-->
        <div class="col-md-2 col-sm-2 location node _left" data-location="left">
            <?php echo !empty($left)?$left: '';?>
        </div>
        <!--main-->
        <div class="col-md-10 col-sm-10 location node _main" data-location="main">
            <?php echo !empty($main)?$main: '';?>
        </div>
    </div>
</div>