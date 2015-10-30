<?php
namespace Blog\Controller\Admin;

use Acl\Form\Admin\FilterAclRole;
use Blog\Form\Admin\BlogPermission;
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
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', PICASO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::acl()->findRoleById($roleId);

        $form = new BlogPermission(['role' => $role]);

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