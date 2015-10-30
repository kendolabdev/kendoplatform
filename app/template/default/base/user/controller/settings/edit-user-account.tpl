<h5 class="lead">
    <?php echo 'Account Settings'; ?>
</h5>

<table class="table table-striped">
    <tbody>
        <tr>
            <th>Profile Name</th>
            <td><?php echo $viewer->getProfileName();?></td>
            <td>
                <?php echo $this->helper()->textLink('core.edit', [], 'user_settings', ['action'=>'edit-name']); ?>
            </td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td><?php echo $viewer->getName(); ?></td>
            <td>
                <?php echo $this->helper()->textLink('core.edit', [], 'user_settings', ['action'=>'edit-username']); ?>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $viewer->getEmail(); ?></td>
            <td>
                <?php echo $this->helper()->textLink('core.edit', [], 'user_settings', ['action'=>'edit-username']); ?>
            </td>
        </tr>
        <tr>
            <th>Gender</th>
            <td><?php echo $viewer->getGender(); ?></td>
            <td>
                <?php echo $this->helper()->textLink('core.edit', [], 'user_settings', ['action'=>'edit-username']); ?>
            </td>
        </tr>
        <tr>
            <th>Birthdate</th>
            <td>15.04.1982</td>
            <td>
                <?php echo $this->helper()->textLink('core.edit', [], 'user_settings', ['action'=>'edit-username']); ?>
            </td>
        </tr>
        <tr>
            <th>Language</th>
            <td>English</td>
            <td>
                <?php echo $this->helper()->textLink('core.edit', [], 'user_settings', ['action'=>'edit-username']); ?>
            </td>
        </tr>
        <tr>
            <th>Password</th>
            <td>*****</td>
            <td>
                <?php echo $this->helper()->textLink('core.edit', [], 'user_settings', ['action'=>'edit-username']); ?>
            </td>
        </tr>
    </tbody>
</table>