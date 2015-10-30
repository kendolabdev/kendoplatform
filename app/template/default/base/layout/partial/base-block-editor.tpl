<div id="<?php echo !empty($block_id)?$block_id:''; ?>" role="button" class="dragable-element" data-anchor="#anchor_div_<?php echo $item->getId();?>"
     data-support="<?php echo $item->getId();?>">
    <div class="dragable-element-header">
        <small><?php echo $item->getTitle(); ?></small>
        <div class="btn-group options right">
            <a role="button"
               class="right"
               data-toggle="options"
               data-remote="admin/layout/ajax/editor/block-options?supportBlockId=<?php echo $item->getId();?>">
                <i class="ion-ios-arrow-down"></i>
            </a>
        </div>
    </div>
</div>