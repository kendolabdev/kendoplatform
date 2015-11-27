<form method="post" enctype="multipart/form-data">
    <input type="file" name="photos[]" accept="image/*" multiple/>
    <br/>
    <button type="submit" class="btn btn-danger"><?php echo $this->helper()->text('core.upload');?></button>
</form>