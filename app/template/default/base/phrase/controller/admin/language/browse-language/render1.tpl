<form method="get">
    <div class="page-heading">
        <h1 class="page-title">Manage Languages</h1>
    </div>
</form>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($items as $item): ?>
    <tr>
        <td><?php echo $item->getId(); ?></td>
        <td><?php echo $item->getName(); ?></td>
        <td>
            <a href="#">Export</a> &middot;
            <a href="#">Enable</a> &middot;
            <a href="#">Disable</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
