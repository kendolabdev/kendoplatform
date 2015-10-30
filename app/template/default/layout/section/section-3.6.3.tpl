<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section" data-render="3.6.3" data-template="default">
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
        <div class="col-md-3 col-sm-3 location node _left" data-location="left">
            <?php echo empty($left)?'':$left;?>
        </div>
        <!-- main -->
        <div class="col-md-6 col-sm-6 location node _main" data-location="main">
            <?php echo empty($main)?'':$main;?>
        </div>
        <!--right-->
        <div class="col-md-3 col-sm-3 location node _right" data-location="right">
            <?php echo empty($right)?'':$right;?>
        </div>
    </div>
</div>