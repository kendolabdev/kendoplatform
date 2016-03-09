<html>
<head>
    <?php echo app()->assetService()->title();?>
</head>
<body>
<?php echo $this->helper()->layout()->renderBlock('\Core\Block\ActionContentBlock',[]);?>
</body>
</html>