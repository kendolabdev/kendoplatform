<?php

namespace Base\Event\Controller\Admin;

use Platform\Acl\Form\Admin\FilterAclRole;
use Base\Event\Form\Admin\EventPermission;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

class PermissionController extends AdminController
{


    /**
     *
     */
    public function actionEdit()
    {
        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'event_extension', 'event_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', KENDO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::aclService()->findRoleById($roleId);

        $form = new EventPermission(['role' => $role]);

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