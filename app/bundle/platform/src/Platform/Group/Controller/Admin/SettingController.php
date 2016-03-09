<?php

namespace Platform\Group\Controller\Admin;

use Platform\Group\Form\Admin\GroupSetting;
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

        app()->layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_settings');

        $form = new GroupSetting([]);

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