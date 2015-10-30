<a role="button"
   data-toggle="btn-album-upload"
   data-target="#upload-new-album-photo">
    <?php echo $this->helper()->text('photo.create_album');?></a>
<input id="upload-new-album-photo" type="file" class="hidden fc-att-photo-input-add" name="photos[]"
       accept="image/*"
       multiple
       data-url="ajax/photo/upload/temp"
       ride="ajaxUploadHandler"
       data-modal="ajax/photo/photo/upload-photo-dialog?albumId=0&mode=1&context=feed"
       data-preview="#upload-album-preview"/>