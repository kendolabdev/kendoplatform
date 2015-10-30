<?php

namespace User\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use User\Form\Admin\FilterUser;

/**
 * Class Manage
 *
 * @package User\Controller\Admin
 */
class ManageController extends AdminController
{

    protected function init()
    {
        parent::init();
    }

    public function actionBrowse()
    {

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_manage');

        $page = $this->request->getParam('page', 1);
        $filter = new FilterUser();

        $filter->setData($this->request->getParams());

        /**
         * supported params
         * role
         */
        $query = $filter->getData();

        $paging = \App::user()
            ->loadAdminUserPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'base/user/controller/admin/manage/browse-user',
            'item_path' => 'base/user/paging/admin/browse-user',
        ]);


        $this->view
            ->setScript($lp->script())
            ->assign([
                'filter'    => $filter,
                'pagingUrl' => 'ajax/user/admin/user/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
            ]);
    }
}