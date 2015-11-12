<?php
namespace Report\Controller\Admin;

use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use Report\Form\Admin\FilterReport;

/**
 * Manage Abuse Report
 * Class ManageController
 *
 * @package Report\Controller\Admin
 */
class ManageController extends AdminController
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


        \App::layout()
            ->setPageName('admin_simple')
            ->setPageTitle('core.abuse_reports')
            ->setPageButtons([$deleteButton])
            ->setupSecondaryNavigation('admin', 'admin_report', 'abuse_reports');
    }

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterReport();

        \App::layout()
            ->setPageTitle('core.abuse_reports')
            ->setPageFilter($filter);

        $filter->isValid([
            'category'  => $this->request->getParam('category'),
            'aboutType' => $this->request->getParam('aboutType'),
        ]);

        $query = $filter->getData();

        $page = $this->request->getParam('page');
        $limit = 10;

        $paging = \App::report()
            ->loadAdminReportPaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/report/controller/admin/manage/browse-report',
            'item_path' => 'base/report/paging/admin/browse-report',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'filter'    => $filter,
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'endless'   => 1,
                'pagingUrl' => 'admin/report/ajax/manage/paging'
            ]);
    }
}