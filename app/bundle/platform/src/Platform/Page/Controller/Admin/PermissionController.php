<?php

namespace Platform\Page\Controller\Admin;

use Platform\Acl\Form\Admin\FilterAclRole;
use Platform\Page\Form\Admin\PagePermission;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class PermissionController
 *
 * @package Page\Controller\Admin
 */
class PermissionController extends AdminController
{

    public function actionEdit()
    {
        \App::layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_permission');

        $filter = new FilterAclRole();

        $roleId = $this->request->getParam('roleId', KENDO_DEFAULT_ROLE_ID);

        $filter->isValid([
            'roleId' => $roleId,
        ]);

        $role = \App::aclService()->findRoleById($roleId);

        $form = new PagePermission(['role' => $role]);

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