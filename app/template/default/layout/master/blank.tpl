<html>
<head>
    <?php echo \App::assetService()->title();?>
</head>
<body>
<?php echo $this->helper()->layout()->renderBlock('\Core\Block\ActionContentBlock',[]);?>
</body>
</html>