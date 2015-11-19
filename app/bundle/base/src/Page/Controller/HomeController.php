<?php

namespace Page\Controller;

use Page\Form\FilterPage;
use Picaso\Controller\DefaultController;

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

        \App::layout()
            ->setupSecondaryNavigation('page_main', null, 'page_browse')
            ->setPageFilter($filter)
            ->setPageTitle('page.pages');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::page()->loadPagePaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

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
        \App::layout()
            ->setupSecondaryNavigation('page_main', null, 'page_my')
            ->setPageTitle('page.pages');

        $poster = \App::auth()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = \App::page()->loadPagePaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

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
        \App::layout()
            ->setupSecondaryNavigation('page_main', null, 'page_my')
            ->setPageTitle('page.pages');
    }
}