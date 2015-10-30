<html>
<head>
    <title>Installation</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3">
        </div>
        <div class="col-md-9 col-sm-9">
            <div class="page-header">
                <h1><?php echo $form->getTitle();?></h1>

                <p><?php echo $form->getNote();?></p>
            </div>
            <?php if(!empty($errorMsg)): ?>
            <div class="alert alert-danger">
                <?php echo $errorMsg;?>
            </div>
            <?php endif; ?>
            <?php echo $form->open();?>
            <?php echo $form->asList(); ?>
            <div class="form-group">
                <button type="submit" class="btn btn-danger">
                    Next Step
                </button>
            </div>
            <?php echo $form->close();?>
        </div>
    </div>
</div>
</body>
</html>