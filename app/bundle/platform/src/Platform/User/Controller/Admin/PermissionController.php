<?php
namespace Platform\User\Controller\Admin;


use Platform\Acl\Form\Admin\FilterAclRole;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\User\Form\Admin\UserPermission;

/**
 * Class PermissionController
 *
 * @package Platform\User\Controller\Admin
 */
class PermissionController extends AdminController
{
    /**
     *
     */
    public function actionEdit()
    {
        $filter = new FilterAclRole();

        app()->layouts()
            ->setPageName('admin_simple')
            ->setPageTitle('user.manage_permission')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_permission');


        $roleId = $this->request->getParam('roleId', KENDO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = app()->aclService()->findRoleById($roleId);

        $form = new UserPermission(['role' => $role]);

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->commit();
        }

        if ($this->request->isMethod('get')) {
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