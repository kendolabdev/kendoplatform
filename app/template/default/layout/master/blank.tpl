<html>
<head>
    <?php echo \App::assets()->title();?>
</head>
<body>
<?php echo $this->helper()->layout()->renderBlock('\Core\Block\ActionContentBlock',[]);?>
</body>
</html>