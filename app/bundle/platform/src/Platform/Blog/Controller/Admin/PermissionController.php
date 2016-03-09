<?php
namespace Platform\Blog\Controller\Admin;

use Platform\Acl\Form\Admin\FilterAclRole;
use Platform\Blog\Form\Admin\BlogPermission;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

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
            ->setPageTitle('blog.manage_permission')
            ->setPageFilter($filter)
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_permission');

        $roleId = $this->request->getParam('roleId', KENDO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = app()->aclService()->findRoleById($roleId);

        $form = new BlogPermission(['role' => $role]);

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