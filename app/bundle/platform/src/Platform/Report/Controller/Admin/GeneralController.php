<?php
namespace Platform\Report\Controller\Admin;

use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\Report\Form\Admin\FilterReport;

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
        $deleteButton = [
            'label' => 'report.delete_all',
            'props' => [
                'class' => 'btn btn-sm btn-danger',
                'href'  => '?delete=all',
            ]
        ];

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setPageTitle('report.general_reports')
            ->setPageButtons([$deleteButton])
            ->setupSecondaryNavigation('admin', 'admin_report', 'general_reports');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterReport();

        \App::layoutService()
            ->setPageFilter($filter)
            ->setPageTitle('report.general_reports');

        $filter->isValid([
            'aboutType' => $this->request->getParam('aboutType'),
        ]);

        $query = $filter->getData();

        $page = $this->request->getParam('page');
        $limit = 10;

        $paging = \App::reportService()
            ->loadAdminGeneralReportPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/report/controller/admin/general-report/browse-general-report',
            'item_path' => 'base/report/paging/admin/browse-general-report',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'endless'   => 1,
                'pagingUrl' => 'admin/report/ajax/general-report/paging'
            ]);
    }
}