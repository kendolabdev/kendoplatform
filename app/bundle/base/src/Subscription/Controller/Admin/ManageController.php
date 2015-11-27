<?php
namespace Subscription\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Subscription\Controller\Admin
 */
class ManageController extends AdminController
{

    protected function onBeforeRender()
    {

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_subscription', 'manage_subscription');
    }


    /**
     *
     */
    public function actionBrowse()
    {
        $lp = new BlockParams([
            'base_path' => '/base/subscription/controller/admin/manage/browse-subscription'
        ]);

        $this->view->setScript($lp)
            ->assign([]);
    }
}