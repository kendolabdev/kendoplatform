<?php
namespace Platform\Navigation\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Platform\Navigation\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        app()->layouts()->setPageName('admin_simple');

        app()->layouts()
            ->setPageName('admin_simple')
            ->setPageTitle('core.manage_navigations')
            ->setupSecondaryNavigation('admin', 'admin_navigation', 'navigation');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $query = [];
        $page = 1;
        $limit = 100;

        $paging = app()->navigation()
            ->loadAdminNavigationPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'platform/navigation/controller/admin/manage/browse-navigation',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
                'pagingUrl' => 'admin/navigation/ajax/manage/paging'
            ]);

    }

    /**
     *
     */
    public function actionEdit()
    {
        app()->assetService()
            ->setTitle(app()->text('core_layout.edit_menu'));

        $lp = new BlockParams([
            'base_path' => 'platform/navigation/controller/admin/manage/edit-navigation',
        ]);

        $this->view
            ->setScript($lp)
            ->assign([]);
    }

}