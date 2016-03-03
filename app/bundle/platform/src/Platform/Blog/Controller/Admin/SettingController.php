<?php
namespace Platform\Blog\Controller\Admin;

use Platform\Blog\Form\Admin\BlogSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

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

        \App::layouts()
            ->setPageName('admin_simple')
            ->setPageTitle('blog.manage_settings')
            ->setPageNote('These settings affected to all members')
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_settings');

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