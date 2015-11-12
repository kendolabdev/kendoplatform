<?php

namespace Page\Controller\Admin;

use Acl\Form\Admin\FilterAclRole;
use Page\Form\Admin\PagePermission;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class PermissionController
 *
 * @package Page\Controller\Admin
 */
class PermissionController extends AdminController
{

    public function actionEdit()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', PICASO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::acl()->findRoleById($roleId);

        $form = new PagePermission(['role' => $role]);

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