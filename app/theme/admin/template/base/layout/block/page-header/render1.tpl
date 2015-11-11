<div class="page-heading">
    <div class="clearfix">
        <div class="pull-left">
            <h1 class="page-title"><?php echo $title; ?></h1>
        </div>
        <div class="pull-right">
            <?php if(!empty($buttons)): ?>
            <div class="btn-group">
                <?php foreach($buttons as $button): ?>
                <a <?php echo _htmlattrs($button['props']);?>><i class="<?php echo $button['icon'];?>"></i> <?php echo $button['label'];?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if(!empty($note)): ?>
    <div class="page-note">
        <?php echo $note; ?>
    </div>
    <?php endif; ?>
</div>