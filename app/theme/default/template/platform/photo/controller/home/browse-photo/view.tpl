<div class="hidden">
    <input id="upload-new-album-photo" type="file" class="hidden fc-att-photo-input-add" name="photos[]"
           accept="image/*"
           multiple
           data-url="ajax/platform/photo/upload/temp"
           ride="ajaxUploadHandler"
           data-modal="ajax/platform/photo/photo/upload-photo-dialog?albumId=0&mode=1&context=photos"
           data-preview="#upload-album-preview"/>
    
    <input id="upload-album-photo" type="file" class="hidden fc-att-photo-input-add" name="photos[]"
           accept="image/*"
           multiple
           data-url="ajax/platform/photo/upload/temp"
           ride="ajaxUploadHandler"
           data-modal="ajax/platform/photo/photo/upload-photo-dialog?albumId=0&mode=0&context=photos"
           data-preview="#upload-album-preview"/>
</div>

<?php echo $this->forward('layout/facade/paging-more/view'); ?>