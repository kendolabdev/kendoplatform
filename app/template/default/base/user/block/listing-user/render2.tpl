<ul class="list-unstyled">
    <?php foreach($paging->items() as $item): ?>
    <li>
        <?php echo $this->helper()->link($item->getTitle(), [], 'profile', ['name'=> $item->getProfileName()]);  ?>
    </li>
    <?php endforeach; ?>
</ul>