<?php
namespace Acl\Controller\Admin;

use Acl\Form\Admin\BasePermission;
use Acl\Form\Admin\FilterPermission;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class PermissionController
 *
 * @package Acl\Controller\Admin
 */
class PermissionController extends AdminController
{

    protected function onBeforeRender()
    {
        $t = $this->request->getParam('t', 'general');
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_permission_edit', $t);

        \App::assets()
            ->title()->set(\App::text('core.manage_permissions'));
    }

    /**
     *
     */
    public function actionEdit()
    {

        $filter = new FilterPermission();

        $filter->isValid($_GET);

        $forward = $this->request->getParam('forward', false);
        $groupId = $this->request->getParam('groupId', 'core');
        $roleId = $this->request->getParam('roleId', null);

        if ($forward) {
            $filter->removeElement('groupId');
        }

        if (true) {
            // remember role id for last edit
            if (empty($roleId))
                $roleId = !empty($_SESSION['roleId']) ? $_SESSION['roleId'] : PICASO_DEFAULT_ROLE_ID;

            if (!empty($roleId))
                $_SESSION['roleId'] = $roleId;
        }

        $group = \App::acl()->findGroupById($groupId);
        $role = \App::acl()->findRoleById($roleId);

        $formClass = $group->getFormClass();

        $form = \App::html()->factory($formClass, ['role' => $role]);

        if (!$form instanceof BasePermission)
            throw new \InvalidArgumentException();

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
                'form'    => $form,
                'filter'  => $filter,
                'groupId' => $groupId,
                'roleId'  => $roleId,
                'forward' => $forward,
            ]);
    }
}