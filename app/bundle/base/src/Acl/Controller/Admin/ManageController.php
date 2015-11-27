<?php
namespace Acl\Controller\Admin;

use Acl\Form\Admin\FilterPermission;
use Core\Form\Admin\CorePermission;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Acl\Controller\Admin
 */
class ManageController extends AdminController
{
    protected function onBeforeRender()
    {
        \App::layoutService()->setPageName('admin_simple')
            ->setPageTitle('core.manage_roles')
            ->setupSecondaryNavigation('admin', 'admin_permission', 'roles');

        \App::assetService()
            ->title()->set(\App::text('core.manage_permissions'));
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $filter = new FilterPermission([]);

        \App::layoutService()
            ->setPageTitle('core.manage_roles')
            ->setPageFilter($filter);

        $roleType = $this->request->getParam('roleType', 'user');


        $filter->isValid(['roleType' => $roleType]);

        $page = $this->request->getParam('page');

        $paging = \App::table('acl.acl_role')
            ->select()
            ->where('role_type=?', $roleType)
            ->paging($page, 1000);

        $lp = new BlockParams([
            'base_path' => 'base/acl/controller/admin/manage/browse-role',
        ]);


        $this->view->setScript($lp)
            ->assign([
                'page'   => $page,
                'paging' => $paging,
                'filter' => $filter,
            ]);
    }


    /**
     *
     */
    public function actionCreate()
    {
        $roleId = 4;
        $groupName = 'core';

        $form = \App::htmlService()->factory('\Core\Form\Admin\Permission', []);

        $this->view->assign([
            'form'      => $form,
            'groupName' => $groupName,
            'roleId'    => $roleId,
        ]);

        $lp = new BlockParams([
            'base_path'=> 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp);
    }

    /**
     *
     */
    public function actionEdit()
    {
        $roleId = 4;
        $groupName = 'core';

        $form = new CorePermission();

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form'      => $form,
                'groupName' => $groupName,
                'roleId'    => $roleId,
            ]);
    }
}