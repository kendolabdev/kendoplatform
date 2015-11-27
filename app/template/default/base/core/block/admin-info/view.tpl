<div class="row">
    <div class="col-sm-3">License</div>
    <div class="col-sm-9 text-right">
        <span class="text-success"><?php echo $license['email']; ?></span>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">Version</div>
    <div class="col-sm-9 text-right">
        <strong class="text-success"><?php echo $version; ?></strong>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">Installation</div>
    <div class="col-sm-9 text-right">
        <span><?php echo $this->helper()->date($date); ?></span>
    </div>
</div>