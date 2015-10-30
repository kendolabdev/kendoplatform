<form method="post" async data-action="admin/layout/ajax/editor/open-block-setting">
    <input type="hidden" name="supportBlockId" value="<?php echo $supportBlockId; ?>"/>
    <input type="hidden" name="blockId" value="<?php echo $blockId; ?>"/>
    <input type="hidden" name="eid" value="<?php echo $eid; ?>"/>
    <input type="hidden" name="pageName" value="<?php echo $pageName; ?>"/>
    <input type="hidden" name="templateId" value="<?php echo $templateId; ?>"/>
    <input type="hidden" name="screenSize" value="<?php echo $screenSize; ?>"/>

    <div class="hyves-content">
        <div class="hyves-header">
            <button type="button" class="close" data-toggle="btn-hyves-close" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="hyves-title"><?php echo $form->getTitle();?></h4>
        </div>
        <div class="hyves-body">
            <h5>
                Select one of following support style.
            </h5>
            <hr/>
            <?php foreach($supportScripts as $key=>$script): ?>
            <h5><?php echo $script['label'];?></h5>
            <p><?php echo $script['note'];?></p>
            <p>
                <label>
                    <input type="radio" name="base_script" value="<?php echo $key;?>" <?php if($key== $baseScript):?>checked<?php endif;?>/>
                    Use this style</label>
            </p>
            <hr/>
            <?php endforeach; ?>
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