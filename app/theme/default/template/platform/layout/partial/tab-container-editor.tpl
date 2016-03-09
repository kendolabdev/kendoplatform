<div role="button"
     class="dragable-element dragable-container"
     data-anchor="#anchor_div_<?php echo $item->getId();?>"
     data-support="<?php echo $item->getId();?>">
    <div class="dragable-element-header">
        <small><?php echo $item->getTitle(); ?></small>
        <a role="button"
           class="options right"
           data-toggle="btn-options"
           data-remote="admin/layout/ajax/editor/block-options?supportBlockId=<?php echo $item->getId();?>">
            <i class="ion-ios-arrow-down"></i>
        </a>
    </div>
    <div class="dragable-element-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 location leaf" data-location="pos0">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>