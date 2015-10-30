<div class="panel panel-default">
    <ul class="list-group">
        <?php foreach($groups as $group): ?>
        <li class="list-group-item">
            <a href="<?php echo $this->helper()->routing()->getUrl('core_admin_permission',['action'=>'allow','groupId'=> $group->getId()]);?>"><?php echo $group->
                getGroupTitle();?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>