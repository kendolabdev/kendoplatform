<?php

namespace Page\Controller\Admin;

use Page\Form\Admin\PageSetting;
use Picaso\Controller\AdminController;


/**
 * Class SettingController
 *
 * @package Page\Controller\Admin
 */
class SettingController extends AdminController
{

    public function actionEdit()
    {

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'group_extension', 'group_settings');

        $form = new PageSetting([]);

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