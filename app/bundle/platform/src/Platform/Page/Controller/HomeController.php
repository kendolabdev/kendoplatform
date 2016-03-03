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

        \App::layouts()
            ->setupSecondaryNavigation('page_main', null, 'page_browse')
            ->setPageFilter($filter)
            ->setPageTitle('page.pages');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::pageService()->loadPagePaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

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
        \App::layouts()
            ->setupSecondaryNavigation('page_main', null, 'page_my')
            ->setPageTitle('page.pages');

        $poster = \App::authService()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = \App::pageService()->loadPagePaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

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
        \App::layouts()
            ->setupSecondaryNavigation('page_main', null, 'page_my')
            ->setPageTitle('page.pages');
    }
}