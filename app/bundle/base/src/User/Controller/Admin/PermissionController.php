<?php
namespace User\Controller\Admin;


use Acl\Form\Admin\FilterAclRole;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
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

        \App::layout()
            ->setPageName('admin_simple')
            ->setPageTitle('user.manage_permission')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_permission');


        $roleId = $this->request->getParam('roleId', PICASO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::acl()->findRoleById($roleId);

        $form = new UserPermission(['role' => $role]);

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->commit();
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path' => 'base/acl/controller/admin/permission/edit-permission',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'form'   => $form,
                'filter' => $filter,
                'roleId' => $roleId,
            ]);
    }
}