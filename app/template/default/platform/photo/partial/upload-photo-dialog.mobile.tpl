<form method="post" data-url="ajax/platform/photo/photo/submit-photos" async>
    <input type="hidden" name="context" value="<?php echo $context; ?>" />
    <div class="hyves-content">
        <div class="hyves-header">
            <div class="pull-right btn-group">
                <button type="button"
                        data-toggle="btn-album-upload"
                        data-target="#upload-more-album-photo"
                        class="btn btn-default btn-sm">
                    <i class="ion-plus"></i> <?php echo $this->helper()->text('photo.photos'); ?>
                </button>
                <?php if($shouldCreateAlbum && $shouldSelectAlbum): ?>
                <button type="button"
                        class="btn btn-default btn-sm"
                        data-toggle="btn-album-switch-mode"
                        data-label1="<?php echo $label1; ?>"
                        data-label0="<?php echo $label0; ?>">
                    <span class="text"><?php echo $label; ?></span>
                </button>
                <?php endif; ?>
            </div>
            <h4 class="hyves-title"><?php echo $modalTitle;?></h4>
            <input id="upload-more-album-photo" type="file"
                   class="hidden"
                   name="photos[]"
                   accept="image/*"
                   multiple
                   data-more=true
                   data-url="ajax/platform/photo/upload/temp"
                   ride="ajaxUploadHandler"
                   data-modal="ajax/platform/photo/photo/upload-photo-dialog"
                   data-preview="#upload-album-preview" />
        </div>
        <div class="hyves-body">
            <!--create album-->
            <div class="photo-album-switch-form mode<?php echo $formMode;?>">
                <input type="hidden" name="new_album" value="<?php echo $useNewAlbum;?>" />
                <div class="photo-create-album-form">
                    <?php echo $formAlbum->asList(); ?>
                </div>
                <!--select album-->
                <?php if(empty($albumId)): ?>
                <div class="photo-select-album-form">
                    <label><?php echo $albumSelect->getLabel();?></label>
                    <div><?php echo $albumSelect->toHtml(); ?></div>
                </div>
                <?php else: ?>
                <input type="hidden" name="album_id" value="<?php echo $albumId; ?>" />
                <?php endif; ?>
            </div>
            <br />
            <div id="upload-album-preview" style="min-height: 100px">
            </div>
        </div>
        <div class="hyves-footer">
            <button type="button"
                    data-toggle="btn-hyves-close"
                    class="btn btn-default">
                <?php echo $this->helper()->text('core.cancel');?>
            </button>
            <button type="submit"
                    class="btn btn-primary">
                <?php echo $this->helper()->text('core.save_changes');?>
            </button>
        </div>
    </div>
</form>