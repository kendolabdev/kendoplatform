<?php
namespace Platform\Notification\Controller;

use Platform\Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Platform\Notification\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function actionBrowseNotification()
    {
        $profile = \App::registryService()
            ->get('profile');

        \App::layoutService()
            ->setPageTitle('notification.notifications');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::notificationService()
            ->loadNotificationPaging($query, $page);

        $lp = \App::layoutService()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
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