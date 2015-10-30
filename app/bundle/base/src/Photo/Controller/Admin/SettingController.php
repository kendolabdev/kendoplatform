<?php

namespace Photo\Controller\Admin;

use Photo\Form\Admin\PhotoSetting;
use Picaso\Controller\AdminController;

/**
 * Class SettingController
 *
 * @package Photo\Controller\Admin
 */
class SettingController extends AdminController
{
    public function actionEdit()
    {
        \App::layout()
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

        $this->view->setScript('base/form-edit')
            ->assign([
                'form' => $form,
            ]);
    }
}