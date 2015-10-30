<?php

namespace Event\Controller\Admin;

use Event\Form\Admin\EventSetting;
use Picaso\Controller\AdminController;

/**
 * Class SettingController
 *
 * @package Event\Controller\Admin
 */
class SettingController extends AdminController
{
    /**
     *
     */
    public function actionEdit()
    {

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'event_extension', 'event_settings');

        $this->request->setParam('name', 'event.admin.event-setting');

        $form = new EventSetting([]);


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