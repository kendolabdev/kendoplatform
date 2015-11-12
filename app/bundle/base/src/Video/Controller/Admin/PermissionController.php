<?php

namespace Video\Controller\Admin;

use Acl\Form\Admin\FilterAclRole;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use Video\Form\Admin\VideoPermission;

class PermissionController extends AdminController
{
    /**
     *
     */
    public function actionEdit()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'video_extension', 'video_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', PICASO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::acl()->findRoleById($roleId);

        $form = new VideoPermission(['role' => $role]);

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