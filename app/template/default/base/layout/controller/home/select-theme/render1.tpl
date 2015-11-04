<div class="page-heading">
    <h1 class="page-title">Select Themes</h1>
</div>
<form method="post">
    <div class="form-group">
        <?php foreach($paging ->items() as $item): ?>
        <div class="radio">
            <label>
                <input type="radio" name="theme_id" value="<?php echo $item->getId();?>"/> <?php echo $item->getTitle();?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="form-group">
        <button class="btn btn-danger">Select Theme</button>
    </div>
</form>