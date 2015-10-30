<?php
namespace Layout\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class TemplateController
 *
 * @package Layout\Controller\Admin
 */
class TemplateController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layout()->setPageName('admin_simple');

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_appearance', 'templates');
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
            'base_path' => 'base/layout/controller/admin/template/browse-template',
        ]);


        $this->view->setScript($lp->script())
            ->setData(['paging' => $paging]);
    }
}