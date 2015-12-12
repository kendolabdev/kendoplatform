<?php
namespace Platform\Acl\Controller\Admin;

use Platform\Acl\Form\Admin\BasePermission;
use Platform\Acl\Form\Admin\FilterPermission;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class PermissionController
 *
 * @package Platform\Acl\Controller\Admin
 */
class PermissionController extends AdminController
{

    protected function onBeforeRender()
    {
        $t = $this->request->getParam('t', 'general');
        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_permission_edit', $t);

        \App::assetService()
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

        \App::layoutService()
            ->setPageFilter($filter)
            ->setPageTitle('core.manage_permission');

        if ($forward) {
            $filter->removeElement('groupId');
        }

        if (true) {
            // remember role id for last edit
            if (empty($roleId))
                $roleId = !empty($_SESSION['roleId']) ? $_SESSION['roleId'] : KENDO_DEFAULT_ROLE_ID;

            if (!empty($roleId))
                $_SESSION['roleId'] = $roleId;
        }

        $group = \App::aclService()->findGroupById($groupId);
        $role = \App::aclService()->findRoleById($roleId);
        $formClass = $group->getFormClass();

        $form = \App::htmlService()->factory($formClass, ['role' => $role]);

        if (!$form instanceof BasePermission)
            throw new \InvalidArgumentException();

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
                'form'    => $form,
                'filter'  => $filter,
                'groupId' => $groupId,
                'roleId'  => $roleId,
                'forward' => $forward,
            ]);
    }
}