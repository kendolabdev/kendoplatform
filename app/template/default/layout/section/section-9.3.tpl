<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section" data-render="9.3" data-template="default">
    <div class="row">
        <?php if(!empty($forEdit)): ?>
        <div class="section-header">
            <div class="btn-group options pull-right">
                <a role="button" class="right" data-toggle="options" data-remote="admin/layout/ajax/editor/section-options">
                    <i class="ion-ios-arrow-down"></i>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <!-- main -->
        <div class="col-md-9 col-sm-9 location node _main" data-location="main">
            <?php echo !empty($main)?$main: ''; ?>
        </div>
        <!-- right -->
        <div class="col-md-3 col-sm-3 location node _right" data-location="right">
            <?php echo !empty($right)?$right: ''; ?>
        </div>
    </div>
</div>