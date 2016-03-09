<?php

namespace Platform\User\Controller;

use Kendo\Controller\DefaultController;
use Platform\User\Form\FilterUser;

/**
 * Class HomeController
 *
 * @package Platform\User\Controller
 */
class HomeController extends DefaultController
{

    /**
     * Uri /members
     */
    public function actionBrowseUser()
    {

        $filter = new FilterUser();

        app()->layouts()
            ->setPageFilter($filter)
            ->setPageTitle('user.browse_members');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = app()->user()->loadUserPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/user/user/paging',
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

        $paging = app()->user()->loadUserPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/user/user/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);

    }
}