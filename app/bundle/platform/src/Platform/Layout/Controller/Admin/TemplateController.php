<?php
namespace Platform\Layout\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class TemplateController
 *
 * @package Platform\Layout\Controller\Admin
 */
class TemplateController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layoutService()->setPageName('admin_simple');

        \App::layoutService()
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

        \App::assetService()
            ->setTitle(\App::text('core_layout.manage_templates'));

        $paging = \App::layoutService()
            ->loadAdminTemplatePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/layout/controller/admin/template/browse-template',
        ]);


        $this->view->setScript($lp)
            ->setData(['paging' => $paging]);
    }
}