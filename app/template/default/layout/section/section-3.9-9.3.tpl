<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section" data-render="3.9-9.3" data-template="default">
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
        <div class="col-sm-3 col-md-3 location node _left" data-location="left">
            <?php echo empty($left)? '': $left; ?>
        </div>
        <div class="col-sm-9 col-md-9">
            <div class="row">
                <!--top-->
                <div class="col-sm-12 col-md-12 location node _top" data-location="top">
                    <?php echo empty($top)? '': $top; ?>
                </div>
                <!--main-->
                <div class="col-sm-9 col-md-9 location node _main" data-location="main">
                    <?php echo empty($main)? '': $main; ?>
                </div>
                <!--right-->
                <div class="col-sm-3 col-md-3 location node _right" data-location="right">
                    <?php echo empty($right)? '': $right; ?>
                </div>
                <!--bottom-->
                <div class="col-sm-12 col-md-12 location node _bottom" data-location="bottom">
                    <?php echo empty($bottom)? '': $bottom; ?>
                </div>
            </div>
        </div>
    </div>
</div>