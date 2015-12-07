<?php
namespace User\Controller\Admin;


use Acl\Form\Admin\FilterAclRole;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use User\Form\Admin\UserPermission;

/**
 * Class PermissionController
 *
 * @package User\Controller\Admin
 */
class PermissionController extends AdminController
{
    /**
     *
     */
    public function actionEdit()
    {
        $filter = new FilterAclRole();

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setPageTitle('user.manage_permission')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_permission');


        $roleId = $this->request->getParam('roleId', Kendo_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::aclService()->findRoleById($roleId);

        $form = new UserPermission(['role' => $role]);

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->commit();
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'form'   => $form,
                'filter' => $filter,
                'roleId' => $roleId,
            ]);
    }
}