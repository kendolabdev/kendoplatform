<div class="page-heading">
    <h1 class="page-title"><?php echo $this->helper()->text('blog.import_blog_posts');?></h1>

    <div class="page-note">
        Support <strong>tumblr</strong>, <strong>blogger</strong>, <strong>wordpress</strong> website.
    </div>
</div>
<form method="post" enctype="multipart/form-data">
    <h5>From URL</h5>

    <p>
        <input type="text" name="url" value="" placeholder="" class="form-control"/>
    </p>
    <h5>From Local XML Files</h5>

    <p>
        Upload xml files <input type="file"/>
    </p>

    <p class="">
        <button class="btn btn-danger">Import Blogs</button>
    </p>
</form>