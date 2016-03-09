<?php

namespace Platform\Page\Controller\Admin;

use Platform\Page\Form\Admin\PageSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;


/**
 * Class SettingController
 *
 * @package Page\Controller\Admin
 */
class SettingController extends AdminController
{

    public function actionEdit()
    {

        app()->layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_settings');

        $form = new PageSetting([]);

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