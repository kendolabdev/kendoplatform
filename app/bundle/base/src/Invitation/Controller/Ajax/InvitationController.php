<?php

namespace Invitation\Controller\Ajax;

use Invitation\Model\Invitation;
use Picaso\Controller\AjaxController;

/**
 * Class InvitationController
 *
 * @package Invitation\Controller\Ajax
 */
class InvitationController extends AjaxController
{

    /**
     * Reset
     */
    public function actionResetMitigated()
    {
        $parent = \App::authService()->getViewer();

        \App::invitationService()
            ->clearMitigatedNotificationState($parent);

    }

    /**
     *
     */
    public function actionCmd()
    {
        list($id, $cmd, $context) = $this->request->get('id', 'cmd', 'ctx');

        if (empty($context))
            $context = 'profile';

        $obj = \App::find('invitation', $id);

        if (!$obj instanceof Invitation) {
            throw new \InvalidArgumentException("Could not find alert");
        }

        $callbackName = \App::inflect(strtr($obj->getTypeId(), ['.' => '-', '_' => '-']));

        switch ($cmd) {
            case 'accept':
                $callbackName = 'onAccept' . $callbackName;
                $this->response['html'] = \App::hook()->callback($callbackName, $obj, $context);
                break;
            case 'deny':
                $callbackName = 'onIgnore' . $callbackName;
                $this->response['html'] = \App::hook()->callback($callbackName, $obj, $context);
                break;
        }
        $this->response['callbackName'] = $callbackName;
    }

    /**
     *
     */
    public function actionBearDialog()
    {
        $viewer = \App::authService()->getViewer();

        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = \App::invitationService()->loadInvitationPaging($query, $page);

        $lp = \App::layoutService()
            ->getContentLayoutParams('invitation_ajax_bear_dialog');

        $this->response = [
            'html' => $this->partial($lp->script(), [
                'pagingUrl' => 'ajax/invitation/invitation/paging',
                'profile'   => $viewer,
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ])
        ];
    }
}