<?php

namespace Event\Controller\Admin;

use Acl\Form\Admin\FilterAclRole;
use Event\Form\Admin\EventPermission;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

class PermissionController extends AdminController
{


    /**
     *
     */
    public function actionEdit()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'event_extension', 'event_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', PICASO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::acl()->findRoleById($roleId);

        $form = new EventPermission(['role' => $role]);

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