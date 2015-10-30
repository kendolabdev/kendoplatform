<?php foreach($paging->items() as $item): ?>
<div class="itlv-msg-conv <?php echo $item->getTypeId();?>"
     data-object="<?php echo $item->getConversationId();?>">
    <?php foreach($item->getOtherRecipients() as $user): ?>
    <a class="avatar" style="background-image: url(<?php echo $user->getPhoto(220);?>)"></a>

    <div class="info-ow">
        <div class="info">
            <div class="profile"><?php echo $user->getTitle();?></div>
            <small class="timeago"><?php echo $this->helper()->timeago($item->getCreatedAt());?></small>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="datetime-others">
        <small class="timeago"><?php echo $this->helper()->timeago($item->getCreatedAt());?></small>
    </div>
    <div class="subject"><?php echo $item->getSubject(); ?></div>
</div>
<?php endforeach; ?>