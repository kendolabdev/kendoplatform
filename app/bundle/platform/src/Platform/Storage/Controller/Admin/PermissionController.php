<?php
namespace Platform\Storage\Controller\Admin;

use Platform\Acl\Form\Admin\FilterAclRole;
use Platform\Comment\Form\Admin\CommentPermission;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class PermissionController
 *
 * @package Platform\Storage\Controller\Admin
 */
class PermissionController extends AdminController
{

    /**
     *
     */
    public function actionEdit()
    {
        app()->layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'photo_extension', 'photo_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', KENDO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = app()->aclService()->findRoleById($roleId);

        $form = new CommentPermission(['role' => $role]);

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