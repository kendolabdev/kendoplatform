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
        app()->layouts()->setPageName('admin_simple');

        app()->layouts()
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

        app()->assetService()
            ->setTitle(app()->text('core_layout.manage_templates'));

        $paging = app()->layouts()
            ->loadAdminTemplatePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'platform/layout/controller/admin/template/browse-template',
        ]);


        $this->view->setScript($lp)
            ->setData(['paging' => $paging]);
    }
}