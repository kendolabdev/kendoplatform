<?php

namespace Platform\Group\Controller\Admin;

use Platform\Group\Form\Admin\FilterGroup;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

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

        \App::layouts()
            ->setPageName('admin_simple')
            ->setPageTitle('group.manage_groups')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_manage');

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = \App::groupService()
            ->loadGroupPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path'      => 'platform/group/controller/admin/manage/browse-group',
            'item_path'      => 'platform/group/paging/admin/browse-group',
            'media_position' => 'media-aside-left',
            'grid_md'        => 'col-md-12',
            'grid_sm'        => 'col-sm-12',
            'endless'        => 1,
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/group/group/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
            ]);
    }
}