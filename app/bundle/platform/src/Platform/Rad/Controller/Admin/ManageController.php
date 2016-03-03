<?php
namespace Platform\Rad\Controller\Admin;

use Kendo\Controller\AdminController;
use Platform\Rad\Form\Admin\CreateModule;
use Platform\Rad\Form\Admin\CreateTheme;

/**
 * Class ManageController
 *
 * @package Rad\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     * @return string
     */
    protected function getVendorId()
    {
        return 'namnv@younetco.com';
    }

    /**
     * Browse admin tools
     */
    public function actionBrowseModule()
    {
        \App::layouts()
            ->setupSecondaryNavigation('admin', 'admin_rad', 'admin_rad_browse_module')
            ->setPageTitle('Your Modules');

        /**
         * kendo platform author
         */
        $vendorId = $this->getVendorId();


        $paging = \App::table('platform_core_extension')
            ->select()
            ->where('extension_type=?', 'module')
            ->where('vendor_id=?', $vendorId)
            ->paging(1, 1000);

        $this->view
            ->setScript('platform/rad/controller/admin/manage/browse-module/view')
            ->assign([
                'paging' => $paging,
            ]);
    }

    /**
     * Browse admin tools
     */
    public function actionBrowseTheme()
    {
        \App::layouts()
            ->setupSecondaryNavigation('admin', 'admin_rad', 'admin_rad_browse_theme')
            ->setPageTitle('Your Themes');

        $vendorId = $this->getVendorId();

        $themes = \App::table('platform_core_extension')
            ->select()
            ->where('extension_type=?', 'theme')
            ->where('vendor_id=?', $vendorId)
            ->paging(1, 1000);


        $this->view
            ->setScript('platform/rad/controller/admin/manage/browse-theme/view')
            ->assign(['paging' => $themes]);
    }

    /**
     *
     */
    public function actionCreateModule()
    {

        $form = new CreateModule();

        \App::layouts()
            ->setupSecondaryNavigation('admin', 'admin_rad', 'admin_rad_create_module')
            ->setPageTitle('Create Module')
            ->setPageNote('Start create new module');


        if ($this->request->isMethod('get')) {

        }

        if ($this->request->isPost()) {

        }

        $this->view->setScript('layout/partial/form-edit/view')
            ->assign(['form' => $form]);
    }

    /**
     *
     */
    public function actionCreateTheme()
    {

        \App::layouts()
            ->setupSecondaryNavigation('admin', 'admin_rad', 'admin_rad_create_theme')
            ->setPageTitle('Create Theme');

        $form = new CreateTheme();

        if ($this->request->isMethod('get')) {

        }

        if ($this->request->isPost()) {

        }

        $this->view->setScript('layout/partial/form-edit/view')
            ->assign(['form' => $form]);
    }
}