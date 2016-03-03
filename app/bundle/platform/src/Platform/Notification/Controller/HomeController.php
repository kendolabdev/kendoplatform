<?php

namespace Platform\Notification\Controller;

use Kendo\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Platform\Notification\Controller
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

        $lp = \App::layouts()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/notification/notification/paging',
                'query'     => $query,
                'pager'     => $paging->getPager(),
                'lp'        => $lp,
                'profile'   => $viewer,
                'paging'    => $paging,
            ]);
    }
}