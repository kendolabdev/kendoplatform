<form method="post" async data-action="admin/layout/ajax/editor/open-content-setting">
    <input type="hidden" name="pageName" value="<?php echo $pageName; ?>"/>
    <input type="hidden" name="templateId" value="<?php echo $templateId; ?>"/>
    <input type="hidden" name="screenSize" value="<?php echo $screenSize; ?>" />
    <input type="hidden" name="layoutType" value="<?php echo $layoutType;?>" />

    <div class="hyves-content">
        <div class="hyves-header">
            <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="hyves-title">Select Content Script</h4>
        </div>
        <div class="hyves-body">
            <p>
                Select one of following scripts.
            </p>
            <?php if(!empty($baseSettings)): ?>
            <div class="list-unstyled">
                <?php foreach($baseSettings as $key=>$item): ?>
                <h6 style="text-transform: uppercase"><?php echo $item['label'];?></h6>

                <p>
                    <?php echo $item['note'];?>
                </p>
                <p>
                    <label><input type="radio" name="base_script" value="<?php echo $key;?>" <?php if($baseScript == $key):?>checked<?php endif;?>/> Use this script</label>
                </p>
                <hr/>
                <?php endforeach;?>
            </div>
            <?php else: ?>
            <blockquote class="bg-danger">
                There is no settings of this page in this template.
            </blockquote>
            <?php endif; ?>

            <?php if(!empty($itemSettings)): ?>
            <blockquote>
                <small>This layout contain multiple items, please select how to display each items by options here.</small>
            </blockquote>
            <div class="list-unstyled">
                <?php foreach($itemSettings as $key=>$item): ?>
                <h6 style="text-transform: uppercase"><?php echo $item['label'];?></h6>

                <p>
                    <?php echo $item['note'];?>
                </p>
                <p>
                    <label><input type="radio" name="item_script" value="<?php echo $key;?>"
                            <?php if($baseScript == $key):?>checked<?php endif;?>/> Use this script</label>
                </p>
                <hr/>
                <?php endforeach;?>
            </div>
            <?php endif; ?>
        </div>
        <div class="hyves-footer">
            <button type="button" class="btn btn-default" data-toggle="btn-hyves-close">
                <?php echo $this->helper()->text('core.close'); ?>
            </button>
            <button type="submit" class="btn btn-primary">
                <?php echo $this->helper()->text('core.continue'); ?>
            </button>
        </div>
    </div>
</form>