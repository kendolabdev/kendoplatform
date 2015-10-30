<?php
namespace Core\Controller\Admin;

use Picaso\Controller\AdminController;

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
        \App::layout()
            ->setPageName('admin_dashboard');

        \App::assets()
            ->setTitle('Admin dashboard');
    }
}