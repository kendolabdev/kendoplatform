<div class="panel panel-default">
    <div class="panel-heading"><?php echo $this->helper()->text('core.information'); ?></div>
    <div class="panel-body">
        <ul class="list-unstyled">
            <li><?php echo $profile->getTitle(); ?></li>
            <li><?php echo $profile->getEmail(); ?></li>
        </ul>
    </div>
</div>