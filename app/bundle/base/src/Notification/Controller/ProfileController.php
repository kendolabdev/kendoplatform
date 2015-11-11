<?php
namespace Notification\Controller;

use Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Notification\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function actionBrowseNotification()
    {
        $profile = \App::registry()
            ->get('profile');

        \App::layout()
            ->setPageTitle('notification.notifications');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::notification()
            ->loadNotificationPaging($query, $page);

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/notification/notification/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'lp'        => $lp,
            ]);
    }
}