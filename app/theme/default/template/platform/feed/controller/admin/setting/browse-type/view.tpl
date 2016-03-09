<div class="page-heading">
    <div class="page-title">
        Manage Activity Types
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
<table class="table table-bordered">
    <thead>
    <tr>
        <td>Type</td>
        <td>Active</td>
        <td>Public</td>
        <td>Main</td>
        <td>Poster</td>
        <td>
            Parent
        </td>
        <td>
            Tagged
        </td>
        <td>
            Options
        </td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paging->items() as $item): ?>
    <tr>
        <td>
            <?php echo $item->toText('activity.label_for_feed_type_'); ?>
        </td>
        <td>
            <?php echo $item->isActive()? $this->helper()->text('core.yes'): $this->helper()->text('core.no'); ?>
        </td>
        <td>
            <?php echo $item->getShowOnPublic()? $this->helper()->text('core.yes'): $this->helper()->text('core.no'); ?>
        </td>
        <td>
            <?php echo $item->getShowOnMain()? $this->helper()->text('core.yes'): $this->helper()->text('core.no'); ?>
        </td>
        <td>
            <?php echo $item->getShowOnPoster()? $this->helper()->text('core.yes'): $this->helper()->text('core.no'); ?>
        </td>
        <td>
            <?php echo $item->getShowOnParent()? $this->helper()->text('core.yes'): $this->helper()->text('core.no'); ?>
        </td>
        <td>
            <?php echo $item->getShowOnTagged()? $this->helper()->text('core.yes'): $this->helper()->text('core.no'); ?>
        </td>
        <td>
            <?php echo $this->helper()->textLink('core.edit', array(),'admin',
            array('any'=>'feed/setting/edit-type','id'=> $item->getId())); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
