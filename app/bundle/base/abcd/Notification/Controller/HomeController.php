<?php

namespace Notification\Controller;

use Kendo\Controller\DefaultController;

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
        $viewer = \App::authService()->getViewer();

        $query = [];

        $page = $this->request->getParam('page', 1);

        $paging = \App::notificationService()
            ->loadNotificationPaging($query, $page, 10);

        $lp = \App::layoutService()
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