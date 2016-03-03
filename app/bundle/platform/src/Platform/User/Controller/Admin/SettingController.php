<?php
namespace Platform\User\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\User\Form\Admin\LoginSetting;
use Platform\User\Form\Admin\RegisterSetting;

/**
 * Class SettingController
 *
 * @package Platform\User\Controller\Admin
 */
class SettingController extends AdminController
{

    /**
     *
     */
    public function actionLogin()
    {

        \App::layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_login_settings');

        $this->request->setParam('name', 'user.admin.login-setting');

        $form = new LoginSetting([]);


        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isMethod('get')) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);

    }

    /**
     *
     */
    public function actionRegister()
    {

        \App::layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_register_settings');

        $this->request->setParam('name', 'user.admin.register-setting');

        $form = new RegisterSetting([]);


        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isMethod('get')) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);

    }
}