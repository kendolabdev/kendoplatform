<a data-toggle="fc-btn-photo"
   class="ion-camera" data-target="#hidden-attatch-photos"
   data-hover="tooltip"
   aria-title="<?php echo $this->helper()->text('photo.add_photo_to_your_post');?>"></a>
<input type="file"
       class="hidden"
       id="hidden-attatch-photos"
       name="photos[]"
       accept="image/*"
       multiple
       data-url="ajax/photo/upload/temp"
       ride="photoComposer"
       data-preview=".fc-upload-photo-preview" />