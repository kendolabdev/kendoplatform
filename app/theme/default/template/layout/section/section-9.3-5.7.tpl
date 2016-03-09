<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section section-main" data-render="section-9.3-5.7" data-template="default">
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
        <div class="col-md-9 col-sm-9">
            <div class="row">
                <!--top-->
                <div class="col-lg-12 col-sm-12 col-md-12 location node _top" data-location="top">
                    <?php echo !empty($top)?$top: ''; ?>
                </div>
                <!--left-->
                <div class="col-lg-5 col-sm-5 col-md-5 location node _left" data-location="left">
                    <?php echo !empty($left)?$left: ''; ?>
                </div>
                <!--main-->
                <div class="col-lg-7 col-sm-7 col-md-7 location node _main" data-location="main">
                    <?php echo !empty($main)?$main: ''; ?>
                </div>
                <!--bottom-->
                <div class="col-lg-12 col-sm-12 col-md-12 location node _bottom" data-location="bottom">
                    <?php echo !empty($bottom)?$bottom: ''; ?>
                </div>
            </div>
        </div>
        <!--right-->
        <div class="col-sm-3 col-md-3 location node _right" data-location="right">
            <?php echo !empty($right)?$right: ''; ?>
        </div>
    </div>
</div>