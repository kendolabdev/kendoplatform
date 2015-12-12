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
        $filter  = new FilterPage();

        \App::layoutService()
            ->setupSecondaryNavigation('page_main', null, 'page_browse')
            ->setPageFilter($filter)
            ->setPageTitle('page.pages');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::pageService()->loadPagePaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/page/page/paging',
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
        \App::layoutService()
            ->setupSecondaryNavigation('page_main', null, 'page_my')
            ->setPageTitle('page.pages');

        $poster = \App::authService()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = \App::pageService()->loadPagePaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/page/page/paging',
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
        \App::layoutService()
            ->setupSecondaryNavigation('page_main', null, 'page_my')
            ->setPageTitle('page.pages');
    }
}