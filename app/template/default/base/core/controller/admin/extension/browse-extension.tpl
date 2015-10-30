<div class="page-heading">
    <h1 class="page-title">Manage Packages</h1>
    <p class="page-note">All installed packages</p>
</div>

<?php if($isEmptyPackage == false): ?>
<h5>Available Packages</h5>
<form method="post">
    <div class="form-group">
        <?php foreach ($packages as $package): ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="select_packages[]" value="<?php echo $package['name']; ?>"/>
                <?php echo $package['name'], ' - ', $package['version'] , ' (', $package['author'], ')' ; ?>
                <div class="help-block">
                    <?php echo $package['description'];?>
                </div>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="form-group">
        <button class="btn btn-danger" type="submit">
            Install
        </button>
    </div>
</form>
<?php endif; ?>

<div class="">
    <h5 data-toggle="expand" data-target="#list_system_package">System Package
        <button class="btn btn-xs btn-info pull-right">
            <i class="ion-more"></i>
        </button></h5>
    <p class="help-block">
        You could not disable system package
    </p>
    <ul class="list-unstyled collapse" id="list_system_package">
        <?php foreach($paging->items() as $item): ?>
        <li class="">
            <h5><?php echo $item->getTitle(); ?>
                <small>
                    - <?php echo $item->getAuthor(); ?>
                    - <?php echo $item->getVersion(); ?>
                </small>
            </h5>
            <p class="help-block">
                <?php echo $this->helper()->text('core_extension.last_update'); ?>: <?php echo $item->getModifiedAt();
                ?>
            </p>

            <p><?php echo $item->getDescription(); ?></p>

            <form class="separate-cmd" method="post">
                <input type="hidden" name="extension_name" value="<?php echo $item->getName();?>"/>
                <?php if($item->canDisable()): ?>
                <button class="btn btn-danger btn-xs" value="disable" name="_cmd">Disable</button>
                <?php endif; ?>
                <?php if($item->canEnable()): ?>
                <button class="btn btn-success btn-xs" value="enable" name="_cmd">Enable</button>
                <?php endif; ?>
                <?php if($item->canUpgrade()): ?>
                <button class="btn btn-info btn-xs" value="upgrade" name="_cmd">Upgrade</button>
                <?php endif; ?>
            </form>
            <hr/>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<hr/>
<div class="">
    <h5 data-toggle="expand" data-target="#list_extend_package">Extends Package
        <button class="btn btn-xs btn-info pull-right">
            <i class="ion-more"></i>
        </button>
    </h5>
    <p class="help-block">
        You can enable/disable packages.
    </p>
    <ul class="list-unstyled collapse" id="list_extend_package">
        <?php foreach($paging2->items() as $item): ?>
        <li class="">
            <h5><?php echo $item->getTitle(); ?>
                <small>
                    - <?php echo $item->getAuthor(); ?>
                    - <?php echo $item->getVersion(); ?>
                </small>
            </h5>
            <p class="help-block">
                <?php echo $this->helper()->text('core_extension.last_update'); ?>: <?php echo $item->getModifiedAt();
                ?>
            </p>

            <p><?php echo $item->getDescription(); ?></p>

            <form class="separate-cmd" method="post">
                <input type="hidden" name="extension_name" value="<?php echo $item->getName();?>"/>
                <?php if($item->canDisable()): ?>
                <button class="btn btn-danger btn-xs" value="disable" name="_cmd">Disable</button>
                <?php endif; ?>
                <?php if($item->canEnable()): ?>
                <button class="btn btn-success btn-xs" value="enable" name="_cmd">Enable</button>
                <?php endif; ?>
                <?php if($item->canUpgrade()): ?>
                <button class="btn btn-info btn-xs" value="upgrade" name="_cmd">Upgrade</button>
                <?php endif; ?>
            </form>
            <hr/>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
