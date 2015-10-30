<?php

namespace Notification\Controller\Ajax;

use Picaso\Controller\AjaxController;
use Picaso\Layout\BlockParams;

/**
 * Class NotificationController
 *
 * @package Notification\Controller\Ajax
 */
class NotificationController extends AjaxController
{

    /**
     * Reset
     */
    public function actionResetMitigated()
    {
        $parent = \App::auth()->getViewer();

        \App::notification()
            ->clearMitigatedNotificationState($parent);

    }


    /**
     * Show beer-dialog
     */
    public function actionBearDialog()
    {
        $viewer = \App::auth()->getViewer();

        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = \App::notification()->loadNotificationPaging($query, $page);

        $lp = \App::layout()
            ->getContentLayoutParams('notification_ajax_bear_dialog');

        $this->response = [
            'html' => $this->partial($lp->script(), [
                'pagingUrl' => 'ajax/notification/notification/paging',
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

        $paging = \App::notification()->loadNotificationPaging($query, $page);

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