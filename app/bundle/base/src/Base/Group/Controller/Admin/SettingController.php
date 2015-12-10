<?php

namespace Base\Group\Controller\Admin;

use Base\Group\Form\Admin\GroupSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;


/**
 * Class SettingController
 *
 * @package Group\Controller\Admin
 */
class SettingController extends AdminController
{

    public function actionEdit()
    {

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_settings');

        $form = new GroupSetting([]);

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