<?php

namespace Platform\Invitation\Controller\Ajax;

use Platform\Invitation\Model\Invitation;
use Kendo\Controller\AjaxController;

/**
 * Class Platform\InvitationController
 *
 * @package Platform\Invitation\Controller\Ajax
 */
class InvitationController extends AjaxController
{

    /**
     * Reset
     */
    public function actionResetMitigated()
    {
        $parent = app()->auth()->getViewer();

        app()->invitationService()
            ->clearMitigatedNotificationState($parent);

    }

    /**
     *
     */
    public function actionCmd()
    {
        list($id, $cmd, $context) = $this->request->getList('id', 'cmd', 'ctx');

        if (empty($context))
            $context = 'profile';

        $obj = app()->find('invitation', $id);

        if (!$obj instanceof Invitation) {
            throw new \InvalidArgumentException("Could not find alert");
        }

        $callbackName = _inflect(strtr($obj->getTypeId(), ['.' => '-', '_' => '-']));

        switch ($cmd) {
            case 'accept':
                $callbackName = 'onAccept' . $callbackName;
                $this->response['html'] = app()->emitter()->callback($callbackName, $obj, $context);
                break;
            case 'deny':
                $callbackName = 'onIgnore' . $callbackName;
                $this->response['html'] = app()->emitter()->callback($callbackName, $obj, $context);
                break;
        }
        $this->response['callbackName'] = $callbackName;
    }

    /**
     *
     */
    public function actionBearDialog()
    {
        $viewer = app()->auth()->getViewer();

        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = app()->invitationService()->loadInvitationPaging($query, $page);

        $lp = app()->layouts()
            ->getContentLayoutParams('invitation_ajax_bear_dialog');

        $this->response = [
            'html' => $this->partial($lp->script(), [
                'pagingUrl' => 'ajax/platform/invitation/invitation/paging',
                'profile'   => $viewer,
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ])
        ];
    }
}