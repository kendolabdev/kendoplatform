<?php
namespace Platform\Acl\Controller\Admin;

use Platform\Comment\Form\Admin\CommentSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class SettingController
 *
 * @package Platform\Acl\Controller\Admin
 */
class SettingController extends AdminController
{

    public function actionEdit()
    {
        \App::layoutService()
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
            'base_path' => 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }
}