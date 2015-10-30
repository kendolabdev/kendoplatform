<div class="options-content">
    <ul class="options-menu">
        <li role="presentation">
            <a data-toggle="dismiss"
               data-url="admin/blog/ajax/manage/delete"
               data-eid="<?php echo $eid;?>"
               data-object='<?php echo _escape($item->toTokenArray());?>'
               role="button">Delete</a>
        </li>
        <?php if(false  == $item->isApproved()): ?>
        <li role="presentation">
            <a data-toggle="dismiss"
               data-url="admin/blog/ajax/manage/approve"
               data-closest="li"
               data-object='<?php echo _escape($item->toTokenArray());?>'
               role="button">Approve this post</a>
        </li>
        <?php endif; ?>
    </ul>
</div>