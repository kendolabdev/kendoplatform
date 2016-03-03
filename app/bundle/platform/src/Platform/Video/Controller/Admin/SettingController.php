<?php

namespace Platform\Video\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\Video\Form\Admin\VideoSetting;


/**
 * Class SettingController
 *
 * @package Video\Controller\Admin
 */
class SettingController extends AdminController
{
    /**
     *
     */
    public function actionEdit()
    {

        \App::layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'video_extension', 'video_settings');

        $this->request->setParam('name', 'video.admin.video-setting');

        $form = new VideoSetting([]);

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