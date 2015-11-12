<?php

namespace Video\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use Video\Form\Admin\VideoSetting;


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

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'video_extension', 'video_settings');

        $this->request->setParam('name', 'video.admin.video-setting');

        $form = new VideoSetting([]);

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