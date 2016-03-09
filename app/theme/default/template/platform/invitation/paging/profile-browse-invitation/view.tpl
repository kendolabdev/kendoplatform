<?php foreach($paging->items() as $item): ?>
<?php $objTxt= json_encode(array('type'=>$item->getType(),'id'=>$item->getId()));?>
<?php if(null == ($poster = $item->getPoster())) continue;?>
<?php echo $item->toHtml(); ?>
<?php endforeach;?>