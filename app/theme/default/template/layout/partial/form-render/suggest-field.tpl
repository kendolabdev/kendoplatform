<div class="_4br">
    <?php foreach($tokens as $token): ?>
    <span class="select-token">
        <?php echo $token->getTitle();?> <input type="hidden" name="<?php echo $name;?>[]" value="<?php echo $token->toToken(); ?>">
        <a class="cleanup ion-backspace" data-toggle="btn-remove-token"></a>
    </span>
    <?php endforeach;?>
    <input <?php echo $attrs;?> />
</div>