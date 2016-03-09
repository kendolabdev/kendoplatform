<?php
namespace Platform\Acl\Controller\Admin;

use Platform\Acl\Form\Admin\FilterPermission;
use Platform\Core\Form\Admin\CorePermission;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Platform\Acl\Controller\Admin
 */
class ManageController extends AdminController
{
    protected function onBeforeRender()
    {
        app()->layouts()->setPageName('admin_simple')
            ->setPageTitle('core.manage_roles')
            ->setupSecondaryNavigation('admin', 'admin_permission', 'roles');

        app()->assetService()
            ->title()->set(app()->text('core.manage_permissions'));
    }

    /**
     *
     */
    public function actionBrowse()
    {

        $filter = new FilterPermission([]);

        app()->layouts()
            ->setPageTitle('core.manage_roles')
            ->setPageFilter($filter);

        $roleType = $this->request->getParam('roleType', 'user');


        $filter->isValid(['roleType' => $roleType]);

        $page = $this->request->getParam('page');

        $paging = app()->table('platform_acl_role')
            ->select()
            ->where('role_type=?', $roleType)
            ->paging($page, 1000);

        $lp = new BlockParams([
            'base_path' => 'platform/acl/controller/admin/manage/browse-role',
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

        $form = app()->html()->factory('\Platform\Core\Form\Admin\Permission', []);

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit'
        ]);

        $this->view
            ->assign([
                'form'      => $form,
                'groupName' => $groupName,
                'roleId'    => $roleId,
            ])
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