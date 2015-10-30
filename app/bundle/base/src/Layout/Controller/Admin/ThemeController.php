<?php
namespace Layout\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ThemeController
 *
 * @package Layout\Controller\Admin
 */
class ThemeController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layout()->setPageName('admin_simple');

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_appearance', 'themes');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $query = [];
        $limit = 100;
        $page = 1;

        \App::assets()
            ->setTitle(\App::text('core_layout.manage_templates'));

        $paging = \App::layout()
            ->loadAdminTemplatePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/layout/controller/admin/theme/browse-theme',
        ]);


        $this->view->setScript($lp->script())
            ->setData(['paging' => $paging]);
    }

}