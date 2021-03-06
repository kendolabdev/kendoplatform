<?php

namespace Platform\Notification\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;

/**
 * Class Platform\NotificationController
 *
 * @package Platform\Notification\Controller\Ajax
 */
class NotificationController extends AjaxController
{

    /**
     * Reset
     */
    public function actionResetMitigated()
    {
        $parent = app()->auth()->getViewer();

        app()->notificationService()
            ->clearMitigatedNotificationState($parent);

    }


    /**
     * Show beer-dialog
     */
    public function actionBearDialog()
    {
        $viewer = app()->auth()->getViewer();

        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = app()->notificationService()->loadNotificationPaging($query, $page);

        $lp = app()->layouts()
            ->getContentLayoutParams('notification_ajax_bear_dialog');

        $this->response = [
            'html' => $this->partial($lp->script(), [
                'pagingUrl' => 'ajax/platform/notification/notification/paging',
                'profile'   => $viewer,
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ])
        ];
    }

    /**
     * Notification paginator load.
     *
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = app()->notificationService()->loadNotificationPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $html = $this->partial($lp->itemScript(), [
            'paging' => $paging,
            'lp'     => $lp
        ]);

        $this->response = [
            'html'    => $html,
            'pager'   => $paging->getPager(),
            'query'   => $query,
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
        ];

    }
}