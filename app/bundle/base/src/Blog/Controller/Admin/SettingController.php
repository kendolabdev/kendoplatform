<?php
namespace Blog\Controller\Admin;

use Blog\Form\Admin\BlogSetting;
use Picaso\Controller\AdminController;

/**
 * Class SettingController
 *
 * @package User\Controller\Admin
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
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_settings');

        $form = new BlogSetting([]);

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $this->view->setScript('base/form-edit')
            ->assign([
                'form' => $form,
            ]);;

    }
}