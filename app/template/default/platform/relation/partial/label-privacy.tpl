<?php if($isOwner): ?>
<span>
    <div class="btn-group">
        <a role="button"
           class="privacy-label"
           data-toggle="options"
           data-remote="ajax/platform/core/privacy/edit-privacy-options"
           data-for="for-icon"
           data-object='<?php echo _escape($about->toTokenArray());?>'
           data-hover="tooltip" data-label='<?php echo _escape($label) ?>'>
    <span class="icon-privacy-type <?php echo $icon;?>" data-hover="tooltip"
          data-label='<?php echo _escape($label) ?>'></span>
            <!--<i class="ion-android-arrow-dropdown"></i>-->
        </a>
    </div>
</span>

<?php else: ?>
<span class="privacy-label" data-hover="tooltip" data-label='<?php echo _escape($label) ?>'>
    <span class="icon-privacy-type <?php echo $icon;?>"></span>
</span>
<?php endif; ?>