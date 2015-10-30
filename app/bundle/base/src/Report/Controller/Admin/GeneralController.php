<?php
namespace Report\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use Report\Form\Admin\FilterReport;

/**
 * Class GeneralController
 *
 * @package Report\Controller\Admin
 */
class GeneralController extends AdminController
{
    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_report', 'general_reports');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterReport();

        $filter->isValid([
            'aboutType' => $this->request->getParam('aboutType'),
        ]);

        $query = $filter->getData();

        $page = $this->request->getParam('page');
        $limit = 10;

        $paging = \App::report()
            ->loadAdminGeneralReportPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/report/controller/admin/general-report/browse-general-report',
            'item_path' => 'base/report/paging/admin/browse-general-report',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'endless'   => 1,
                'pagingUrl' => 'admin/report/ajax/general-report/paging'
            ]);
    }
}