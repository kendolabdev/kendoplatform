<?php foreach($paging->items() as $item):
$poster  = $item->getPoster();
if(!$poster) continue;
$attrs  = $item->toTokenArray();
?>
<?php echo $item->toHtml();?>
<?php endforeach;?>