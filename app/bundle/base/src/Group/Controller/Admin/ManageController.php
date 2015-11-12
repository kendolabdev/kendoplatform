<?php

namespace Group\Controller\Admin;

use Group\Form\Admin\FilterGroup;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Group\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterGroup();

        \App::layout()
            ->setPageName('admin_simple')
            ->setPageTitle('group.manage_groups')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_manage');

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = \App::group()
            ->loadGroupPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path'      => 'base/group/controller/admin/manage/browse-group',
            'item_path'      => 'base/group/paging/admin/browse-group',
            'media_position' => 'media-aside-left',
            'grid_md'        => 'col-md-12',
            'grid_sm'        => 'col-sm-12',
            'endless'        => 1,
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/group/group/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
            ]);
    }
}