<?php

namespace Page\Controller;

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
        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::page()->loadPagePaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
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
        $poster = \App::auth()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = \App::page()->loadPagePaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/page/page/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }
}