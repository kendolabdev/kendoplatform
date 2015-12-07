<?php

namespace Group\Controller\Admin;

use Acl\Form\Admin\FilterAclRole;
use Group\Form\Admin\GroupPermission;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;


/**
 * Class PermissionController
 *
 * @package Group\Controller\Admin
 */
class PermissionController extends AdminController
{

    public function actionEdit()
    {
        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', Kendo_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::aclService()->findRoleById($roleId);

        $form = new GroupPermission(['role' => $role]);

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