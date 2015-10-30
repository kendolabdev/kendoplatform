<div class="place-att-ow">
    <a class="item-photo" role="button">
        <img src="<?php echo $photoUrl;?>" style="max-width:100%" />
    </a>
    <div class="item-info">
        <div class="item-title"><?php echo $place->getTitle();?></div>
        <div class="item-desc"><?php echo $place->getAddress();?></div>
    </div>
</div>
