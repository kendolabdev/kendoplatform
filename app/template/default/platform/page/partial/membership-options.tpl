<?php if($likeStatus == 1): ?>
<div class="options-content">
    <ul class="options-menu">
        <li data-toggle="btn-friend-addlist" data-eid="<?php echo $eid;?>" data-object='<?php echo _escape($item->toTokenArray());?>'>
            <a role="button">
                <i class="ion-ios-list-outline  "></i>
                <?php echo $this->helper()->text('core.add_to_interest_list');?>
            </a>
        </li>

        <li data-toggle="link-toggle-follow" data-eid="<?php echo $eid;?>" data-object='<?php echo _escape($item->toTokenArray());?>'>
            <?php if($followStatus == 0): ?>
            <a role="button">
                <i class="ion-social-rss"></i>
                <?php echo $this->helper()->text('core.follow');?>
            </a>
            <?php endif; ?>
            <?php if($followStatus == 1): ?>
            <a role="button">
                <i class="ion-social-rss"></i>
                <?php echo $this->helper()->text('core.following');?>
            </a>
            <?php endif; ?>
        </li>
        <li class="divider"></li>
        <li data-toggle="membership-like-toggle"
            data-eid="<?php echo $eid;?>"
            data-object='<?php echo _escape($item->toTokenArray());?>'>
            <a role="button">
                <?php echo $this->helper()->text('core.unlike');?>
            </a></li>
    </ul>
</div>
<?php endif;?>