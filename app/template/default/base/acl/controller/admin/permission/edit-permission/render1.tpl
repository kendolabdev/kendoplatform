<div class="page-heading">
    <h1 class="page-title"><?php echo $form->getTitle();?></h1>

    <div class="page-note">
        <?php echo $form->getNote(); ?>
    </div>
    <div class="page-note">
        <form class="form form-inline">
            <?php echo $filter->asList();?>
            <div class="form-group">
                <br/>
                <button type="submit" class="btn btn-warning">Search</button>
            </div>
        </form>
    </div>
</div>
<?php echo $form->open(); ?>

<?php echo $form->asList(); ?>

<div class="form-group">
    <?php if(!$form->hasElement('_submit')): ?>
    <button type="submit" class="btn btn-danger" name="_submit"><?php echo $this->
        helper()->text('core.save_changes'); ?>
    </button>
    <?php endif; ?>
</div>
<?php echo $form->close(); ?>