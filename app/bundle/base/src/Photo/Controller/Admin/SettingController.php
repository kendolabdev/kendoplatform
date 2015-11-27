<?php

namespace Photo\Controller\Admin;

use Photo\Form\Admin\PhotoSetting;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class SettingController
 *
 * @package Photo\Controller\Admin
 */
class SettingController extends AdminController
{
    public function actionEdit()
    {
        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'photo_extension', 'photo_settings');

        $this->request->setParam('name', 'photo.admin.photo-setting');

        $form = new PhotoSetting([]);


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