<div class="pager nextprev">
    <?php if($hasPrev || $hasNext): ?>
    <a role="button" data-toggle="pager" data-pager='prev' class="pager-prev <?php echo $hasPrev?'':'disabled'?>"
       href="<?php echo $prevUrl;?>"><span>Prev</span></a>
    <a role="button" data-toggle="pager" data-pager='next' class="pager-next <?php echo $hasNext?'':'disabled'?>"
       href="<?php echo $nextUrl;?>"><span>Next</span></a>
    <?php endif; ?>
</div>