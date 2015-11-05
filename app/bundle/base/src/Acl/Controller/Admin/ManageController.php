<?php
namespace Acl\Controller\Admin;

use Acl\Form\Admin\FilterPermission;
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
        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_permission', 'roles');

        \App::assets()
            ->title()->set(\App::text('core.manage_permissions'));
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $roleType = $this->request->getParam('roleType', 'user');

        $filter = new FilterPermission([]);

        $filter->isValid(['roleType' => $roleType]);

        $page = $this->request->getParam('page');

        $paging = \App::table('acl.acl_role')
            ->select()
            ->where('role_type=?', $roleType)
            ->paging($page, 1000);

        $lp = new BlockParams([
            'base_path' => 'base/acl/controller/admin/manage/browse-role',
        ]);


        $this->view->setScript($lp->script())
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

        $form = \App::html()->factory('\Core\Form\Admin\Permission', []);

        $this->view->assign([
            'form'      => $form,
            'groupName' => $groupName,
            'roleId'    => $roleId,
        ]);

        $this->view->setScript('base/form-edit');
    }

    /**
     *
     */
    public function actionEdit()
    {
        $roleId = 4;
        $groupName = 'core';

        $form = \App::html()->factory('\Core\Form\Admin\Permission', []);

        $this->view->assign([
            'form'      => $form,
            'groupName' => $groupName,
            'roleId'    => $roleId,
        ]);

        $this->view->setScript('base/form-edit');
    }
}