<?php
namespace Like\Controller\Admin;

use Comment\Form\Admin\CommentSetting;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class SettingController
 *
 * @package Like\Controller\Admin
 */
class SettingController extends AdminController
{

    public function actionEdit()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'photo_extension', 'photo_settings');

        $this->request->setParam('name', 'photo.admin.photo-setting');

        $form = new CommentSetting([]);


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