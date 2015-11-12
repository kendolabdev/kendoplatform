<table class="table table-bordered">
    <thead>
    <tr>
        <td><?php echo $this->helper()->text('core_layout.layout_name'); ?></td>
        <td><?php echo $this->helper()->text('core.edit_layout'); ?></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($paging->items() as $item):?>
    <tr>
        <td><?php echo $item->getPageName(); ?></td>
        <td class="separate-cmd">
            <a href="<?php echo $this->helper()->url('admin',['stuff'=>'layout/manage/edit',
            'screenSize'=>'desktop','pageName'=>$item->getPageName()]);?>" title="desktop"><i
                    class="fa fa-desktop"></i></a>

            <a href="<?php echo $this->helper()->url('admin',['stuff'=>'layout/manage/edit',
            'screenSize'=>'tablet','pageName'=>$item->getPageName()]);?>" title="tablet"><i
                    class="fa fa-tablet"></i></a>
            <a href="<?php echo $this->helper()->url('admin',['stuff'=>'layout/manage/edit',
            'screenSize'=>'mobile','pageName'=>$item->getPageName()]);?>" title="phone"><i
                    class="fa fa-mobile-phone"></i></a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>