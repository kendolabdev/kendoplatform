<?php echo $form->open(); ?>
<div class="row _pb-large">
    <div class="col-sm-4">
        <?php echo $form->getElement('q')->toHtml();?>
    </div>
    <div class="label-inline">
        <?php echo $this->helper()->text('core.order');?>
    </div>
    <div class="col-sm-3">
        <?php echo $form->getElement('order')->toHtml();?>
    </div>
    <div class="label-inline">
        <?php echo $form->getElement('_submit')->toHtml();?>
    </div>
</div>
<?php echo $form->close(); ?>