<?php
namespace Review\Controller\Admin;

use Acl\Form\Admin\FilterAclRole;
use Comment\Form\Admin\CommentPermission;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class PermissionController
 *
 * @package Review\Controller\Admin
 */
class PermissionController extends AdminController
{

    /**
     *
     */
    public function actionEdit()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'photo_extension', 'photo_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', PICASO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::acl()->findRoleById($roleId);

        $form = new CommentPermission(['role' => $role]);

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