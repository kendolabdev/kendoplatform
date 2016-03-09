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
        app()->assetService()
            ->setTitle('Admin dashboard');

        app()->layouts()
            ->setPageName('admin_dashboard');
    }
}