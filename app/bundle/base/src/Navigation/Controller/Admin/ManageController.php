<?php
namespace Navigation\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Navigation\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layout()->setPageName('admin_simple');

        \App::layout()
            ->setPageName('admin_simple')
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

        $paging = \App::nav()
            ->loadAdminNavigationPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/navigation/controller/admin/manage/browse-navigation',
        ]);

        $this->view->setScript($lp->script())
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
        \App::assets()
            ->setTitle(\App::text('core_layout.edit_menu'));

        $lp = new BlockParams([
            'base_path' => 'base/navigation/controller/admin/manage/edit-navigation',
        ]);

        $this->view
            ->setScript($lp->script())
            ->assign([]);
    }

}