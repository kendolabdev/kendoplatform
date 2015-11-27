<div class="col-md-3">
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
<div class="col-md-9">
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

<div class="col-md-12">
    <hr/>
</div>
<div class="col-md-3">
    <?php foreach($items as $item): ?>
    <div class="itlv-msg">
        <?php echo $item->getSubject(); ?>
        <hr/>
    </div>
    <?php endforeach; ?>
</div>
<div class="col-md-9"></div>