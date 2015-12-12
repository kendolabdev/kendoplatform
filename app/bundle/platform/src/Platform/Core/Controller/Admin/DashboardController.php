<?php
namespace Platform\Core\Controller\Admin;

use Kendo\Controller\AdminController;

/**
 * Class DashboardController
 *
 * @package Core\Controller\Admin
 */
class DashboardController extends AdminController
{

    /**
     *
     */
    public function actionIndex()
    {
        \App::assetService()
            ->setTitle('Admin dashboard');

        \App::layoutService()
            ->setPageName('admin_dashboard');
    }
}