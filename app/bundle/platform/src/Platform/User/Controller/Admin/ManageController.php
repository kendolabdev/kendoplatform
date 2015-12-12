<?php

namespace Platform\User\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\User\Form\Admin\FilterUser;

/**
 * Class Manage
 *
 * @package Platform\User\Controller\Admin
 */
class ManageController extends AdminController
{

    protected function init()
    {
        parent::init();
    }

    public function actionBrowse()
    {

        $filter = new FilterUser();

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setPageTitle('user.manage_members')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_manage');

        $page = $this->request->getParam('page', 1);


        $filter->setData($this->request->getParams());

        /**
         * supported params
         * role
         */
        $query = $filter->getData();

        $paging = \App::userService()
            ->loadAdminUserPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'platform/user/controller/admin/manage/browse-user',
            'item_path' => 'platform/user/paging/admin/browse-user',
        ]);


        $this->view
            ->setScript($lp)
            ->assign([
                'filter'    => $filter,
                'pagingUrl' => 'ajax/user/admin/user/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
            ]);
    }
}