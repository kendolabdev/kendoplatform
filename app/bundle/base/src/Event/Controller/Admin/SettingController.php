<?php

namespace Event\Controller\Admin;

use Event\Form\Admin\EventSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

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

        \App::layoutService()
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