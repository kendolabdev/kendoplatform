<div class="clearfix">
    <div class="col-md-4">
        <div class="btn-group">
            <a href="<?php echo $this->helper()->url('message_inbox'); ?>"
               class="btn btn-sm btn-default">
                    <span class="txt">
                        <?php echo $this->helper()->text('message.inbox');?>
                    </span>
            </a>
            <a href="<?php echo $this->helper()->url('message_sent'); ?>"
               class="btn btn-sm btn-default">
                    <span class="txt">
                        <?php echo $this->helper()->text('message.sent');?>
                    </span>
            </a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="pull-right">
            <div class="btn-group">
                <a href="<?php echo $this->helper()->url('message_compose'); ?>"
                   class="btn btn-sm btn-default">
                    <span class="ion-plus">
                    </span>
                    <span class="txt">
                        <?php echo $this->helper()->text('message.new_message');?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <hr/>
</div>
<div class="clearfix">
    <div class="col-md-4">
        <?php foreach($items as $item): ?>
        <div class="itlv-msg-conv <?php echo $item->getTypeId();?>" data-object="<?php echo $item->getConversationId();?>">
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
    </div>
    <div class="col-md-8"></div>
</div>
