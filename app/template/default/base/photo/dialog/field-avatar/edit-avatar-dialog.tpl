<form method="post" async data-action="ajax/photo/avatar/update-avatar">
    <div class="hyves-content">
        <div class="hyves-header">
            <h4 class="hyves-title"><?php echo $this->helper()->text('user.edit_profile_photo');?></h4>
        </div>
        <div class="hyves-body">
            <div class="cropit-container" data-src="<?php echo $photoSource;?>">
                <div class="cropit-overlay">
                    <div class="cropit-overlay-stage">
                        <div class="cropit-content">
                        </div>
                    </div>
                    <div class="cropit-thumbnail"></div>
                    <div class="zoom-range">
                        <input
                                class="cropit-zoom hidden"
                                type="range" value=""
                                min="0"
                                max="100"
                                step="1"
                                data-orientation="horizontal"/>
                        <input type="hidden" class="cropit_url" name="cropit[url]" value="<?php echo $photoSource;?>"/>
                        <input type="hidden" class="cropit_options" name="cropit[options]" value=""/>
                        <input type="hidden" class="hidden" name="cropit[fileId]"
                               value="<?php echo $photoFileId;?>"/>
                        <input type="hidden" class="hidden" name="cropit[photoId]"
                               value="<?php echo $photoId;?>"/>
                        <input type="hidden" class="cropit_temp_id" name="cropit[tempId]"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="hyves-footer">
            <button type="button"
                    data-toggle="btn-hyves-close"
                    class="btn btn-default">
                <?php echo $this->helper()->text('core.cancel');?>
            </button>
            <button type="submit" class="btn btn-primary avatar-export">
                <?php echo $this->helper()->text('core.save_changes');?>
            </button>
        </div>
    </div>
</form>
<?php echo \App::assets()->requirejs()->renderScriptHtml(); ?>