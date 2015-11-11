<?php
namespace Rad\Controller\Admin;

use Picaso\Controller\AdminController;
use Rad\Form\Admin\CreateExtension;
use Rad\Form\Admin\CreateTheme;

/**
 * Class ManageController
 *
 * @package Rad\Controller\Admin
 */
class ManageController extends AdminController
{
    /**
     * Browse admin tools
     */
    public function actionBrowseExtension()
    {
        \App::layout()
            ->setupSecondaryNavigation('admin', 'admin_rad', 'admin_rad_browse_extension')
            ->setPageTitle('Your Extensions');


        $paging = \App::table('core.core_extension')
            ->select()
            ->where('vendor_id=?', 'namnv@younetco.com')
            ->paging(1, 1000);

        $this->view
            ->setScript('base/rad/controller/admin/manage/browse-extension/render1')
            ->assign(['paging' => $paging]);
    }

    /**
     * Browse admin tools
     */
    public function actionBrowseTheme()
    {
        \App::layout()
            ->setupSecondaryNavigation('admin', 'admin_rad', 'admin_rad_browse_theme')
            ->setPageTitle('Your Themes');


        $paging = \App::table('layout.layout_theme')
            ->select()
            ->where('vendor_id=?', 'namnv@younetco.com')
            ->paging(1, 1000);

        $this->view
            ->setScript('base/rad/controller/admin/manage/browse-theme/render1')
            ->assign(['paging' => $paging]);
    }

    /**
     *
     */
    public function actionCreateExtension()
    {

        $form = new CreateExtension();

        \App::layout()
            ->setupSecondaryNavigation('admin', 'admin_rad', 'admin_rad_create_extension')
            ->setPageTitle('Create new extension')
            ->setPageNote('Start create new extension');


        if ($this->request->isGet()) {

        }

        if ($this->request->isPost()) {

        }

        $this->view->setScript('base/core/form-edit/render1')
            ->assign(['form' => $form]);
    }

    /**
     *
     */
    public function actionCreateTheme()
    {

        \App::layout()
            ->setupSecondaryNavigation('admin', 'admin_rad', 'admin_rad_create_theme')
            ->setPageTitle('Create new theme');

        $form = new CreateTheme();

        if ($this->request->isGet()) {

        }

        if ($this->request->isPost()) {

        }

        $this->view->setScript('base/core/form-edit/render1')
            ->assign(['form' => $form]);
    }
}