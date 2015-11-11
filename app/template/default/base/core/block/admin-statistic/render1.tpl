<?php foreach($stats as $key=>$item): ?>
<div class="row">
    <div class="col-sm-3"><?php echo $item['label'];?></div>
    <div class="col-sm-9 text-right"><strong><?php echo $item['value'];?></strong></div>
</div>
<?php endforeach; ?>