<div class="options-content">
    <ul class="options-menu">
        <li>
            <a role="button" class=""
               data-toggle="dismiss"
               data-closest=".card-wrap"
               data-eid="<?php echo $eid ?>"
               data-object='<?php echo $token;?>'>
                <i class="ion-android-delete"></i> Delete this member
            </a>
        </li>
        <?php if($item->isActive()): ?>
        <li>
            <a role="button" class=""
               data-toggle="dismiss"
               data-closest=".options-dialog"
               data-url="ajax/user/admin/user/disable"
               data-object='<?php echo $token;?>'>
                <i class="ion-locked"></i> Un-active this member
            </a>
        </li>
        <?php else: ?>
        <li>
            <a role="button" class=""
               data-toggle="dismiss"
               data-closest=".options-dialog"
               data-url="ajax/user/admin/user/enable"
               data-object='<?php echo $token;?>'>
                <i class="ion-unlocked"></i> Active this member
            </a>
        </li>
        <?php endif;?>
        <?php if(!$item->isVerified()): ?>
        <li>
            <a role="button" class=""
               data-toggle="dismiss"
               data-closest="li"
               data-object='<?php echo $token;?>'
               data-url="ajax/user/admin/user/verify">
                <i class="ion-checkmark"></i> Set email verified
            </a>
        </li>
        <?php endif; ?>
        <?php if(!$item->isApproved()): ?>
        <li>
            <a role="button" class=""
               data-toggle="dismiss"
               data-closest="li"
               data-object='<?php echo $token;?>'
               data-url="ajax/user/admin/user/approve">
                <i class="ion-checkmark"></i>Approve this member
            </a>
        </li>
        <?php endif; ?>
    </ul>
</div>