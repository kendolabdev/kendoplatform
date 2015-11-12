<?php
namespace Blog\Controller\Admin;

use Blog\Form\Admin\BlogSetting;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

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

        $form = new BlogSetting([]);

        \App::layout()
            ->setPageName('admin_simple')
            ->setPageTitle('blog.manage_settings')
            ->setPageNote('These settings affected to all members')
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_settings');

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