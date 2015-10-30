<?php

namespace User\Controller;

use Picaso\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package User\Controller
 */
class HomeController extends DefaultController
{

    /**
     * Uri /members
     */
    public function actionBrowseUser()
    {
        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::user()->loadUserPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/user/user/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     * Find current viewer friends
     */
    public function actionFindFriend()
    {
        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::user()->loadUserPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/user/user/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);

    }
}