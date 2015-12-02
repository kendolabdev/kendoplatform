<div id="<?php echo !empty($section_id)?$section_id:'';?>" class="section section-sub" data-render="container-3-3-3-3"
     data-template="default">
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
        <div class="col-md-3 col-sm-3 location main"></div>
        <div class="col-md-3 col-sm-3 location main"></div>
        <div class="col-md-3 col-sm-3 location main"></div>
        <div class="col-md-3 col-sm-3 location main"></div>
    </div>
</div>