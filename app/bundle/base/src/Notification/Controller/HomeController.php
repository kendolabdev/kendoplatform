<?php

namespace Notification\Controller;

use Picaso\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Notification\Controller
 */
class HomeController extends DefaultController
{
    /**
     *
     */
    public function actionBrowseNotification()
    {
        $viewer = \App::auth()->getViewer();

        $query = [];

        $page = $this->request->getParam('page', 1);

        $paging = \App::notification()
            ->loadNotificationPaging($query, $page, 10);

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/notification/notification/paging',
                'query'     => $query,
                'pager'     => $paging->getPager(),
                'lp'        => $lp,
                'profile'   => $viewer,
                'paging'    => $paging,
            ]);
    }
}