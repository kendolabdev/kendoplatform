<?php

namespace Platform\Page\Controller;

use Platform\Page\Form\FilterPage;
use Kendo\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Page\Controller
 */
class HomeController extends DefaultController
{
    /**
     *
     */
    public function actionBrowsePage()
    {
        $filter = new FilterPage();

        app()->layouts()
            ->setupSecondaryNavigation('page_main', null, 'page_browse')
            ->setPageFilter($filter)
            ->setPageTitle('page.pages');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = app()->pageService()->loadPagePaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/page/page/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionMyPage()
    {
        app()->layouts()
            ->setupSecondaryNavigation('page_main', null, 'page_my')
            ->setPageTitle('page.pages');

        $poster = app()->auth()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = app()->pageService()->loadPagePaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/page/page/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionCreatePage()
    {
        app()->layouts()
            ->setupSecondaryNavigation('page_main', null, 'page_my')
            ->setPageTitle('page.pages');
    }
}