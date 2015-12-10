<div>
    <ul class="nav nav-tabs" role="tablist">
        <?php foreach($tabs as $tab): ?>
        <li role="presentation" class="<?php echo $tab['active']?'active':'';?>">
            <a role="tab" data-toggle="tab" href="#<?php echo $tab['id'];?>" aria-controls="<?php echo $tab['id'];?>" >
                <?php echo $tab['title'];?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content">
        <?php foreach($tabs as $tab): ?>
        <div role="tabpanel" class="tab-pane <?php echo $tab['active']?'active':'';?>" id="<?php echo $tab['id'];?>">
            <?php echo $tab['content']; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>