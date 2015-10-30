<ul class="nav nav-pills nav-stacked">
    <?php foreach($steps as $step): ?>
    <li role="presentation">
        <a href="<?php echo $this->helper()->url('edit_profile', array('stepNumber'=> $step->getStepNumber())); ?>">
            <?php echo $this->helper()->text($step->getTitle()); ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>