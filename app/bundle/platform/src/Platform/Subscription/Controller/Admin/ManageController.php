<?php
namespace Platform\Subscription\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Base\Subscription\Controller\Admin
 */
class ManageController extends AdminController
{

    protected function onBeforeRender()
    {

        \App::layouts()
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