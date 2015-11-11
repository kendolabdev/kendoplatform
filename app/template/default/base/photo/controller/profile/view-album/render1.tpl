<div class="page-heading">
    <div class="row page-note">
        <div class="col-md-6 col-sm-6">
            <div class="btn-group">
                <a class="btn btn-sm btn-default"
                   href="<?php echo $profile->toHref(array('stuff'=>'photos'));?>">Photos</a>
                <a class="btn btn-sm btn-default"
                   href="<?php echo $profile->toHref(array('stuff'=>'albums'));?>">Albums</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 text-right">
            <div class="btn-group">
                <a role="button"
                   class="btn btn-default btn-sm"
                   data-toggle="btn-album-upload"
                   data-target="#upload-album-photo">
                    <i class="ion-plus"></i> <?php echo $this->helper()->text('photo.upload_photos');?>
                </a>
                <a role="button"
                   class="btn btn-default btn-sm"
                   data-toggle="btn-album-upload"
                   data-target="#upload-new-album-photo">
                    <i class="ion-plus"></i> <?php echo $this->helper()->text('photo.create_album');?>
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

<?php echo $this->forward('layout/decorator/paging-more'); ?>