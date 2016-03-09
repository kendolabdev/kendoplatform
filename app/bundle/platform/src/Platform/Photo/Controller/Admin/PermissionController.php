<?php
namespace Platform\Photo\Controller\Admin;

use Platform\Acl\Form\Admin\FilterAclRole;
use Platform\Photo\Form\Admin\PhotoPermission;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class PermissionController
 *
 * @package Platform\Photo\Controller\Admin
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

        $form = new PhotoPermission(['role' => $role]);

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