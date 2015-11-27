<div class="page-heading">
    <div class="row page-note">
        <div class="col-md-6 col-sm-6 col-xs-9 text-right">
            <div class="btn-group">
                <a role="button"
                   class="btn btn-default btn-sm"
                   data-toggle="btn-album-upload"
                   data-target="#upload-album-photo">
                    <i class="ion-plus"></i> <?php echo $this->helper()->text('photo.photos');?>
                </a>
                <a role="button"
                   class="btn btn-default btn-sm"
                   data-toggle="btn-album-upload"
                   data-target="#upload-new-album-photo">
                    <i class="ion-plus"></i> <?php echo $this->helper()->text('photo.album');?>
                </a>
            </div>

            <input id="upload-new-album-photo" type="file" class="hidden fc-att-photo-input-add" name="photos[]"
                   accept="image/*"
                   multiple
                   data-url="ajax/photo/upload/temp"
                   ride="ajaxUploadHandler"
                   data-modal="ajax/photo/photo/upload-photo-dialog?albumId=0&mode=1&context=profile_photos&parentId=<?php echo $profile->getId();?>&parentType=<?php echo $profile->getType();?>"
                   data-preview="#upload-album-preview"/>
            <input id="upload-album-photo" type="file" class="hidden fc-att-photo-input-add" name="photos[]"
                   accept="image/*"
                   multiple
                   data-url="ajax/photo/upload/temp"
                   ride="ajaxUploadHandler"
                   data-modal="ajax/photo/photo/upload-photo-dialog?albumId=0&mode=0&context=profile_photos&parentId=<?php echo $profile->getId();?>&parentType=<?php echo $profile->getType();?>"
                   data-preview="#upload-album-preview"/>
        </div>
    </div>
</div>

<?php echo $this->forward('layout/facade/paging-more/view'); ?>