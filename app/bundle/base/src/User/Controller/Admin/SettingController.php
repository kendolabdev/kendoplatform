<?php
namespace User\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use User\Form\Admin\LoginSetting;
use User\Form\Admin\RegisterSetting;

/**
 * Class SettingController
 *
 * @package User\Controller\Admin
 */
class SettingController extends AdminController
{

    /**
     *
     */
    public function actionLogin()
    {

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_login_settings');

        $this->request->setParam('name', 'user.admin.login-setting');

        $form = new LoginSetting([]);


        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path'=> 'layout/partial/form-edit'
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

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_manage_member', 'user_register_settings');

        $this->request->setParam('name', 'user.admin.register-setting');

        $form = new RegisterSetting([]);


        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path'=> 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);

    }
}