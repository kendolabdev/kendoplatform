<?php

namespace Invitation\Controller;

use Picaso\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Invitation\Controller
 */
class HomeController extends DefaultController
{

    /**
     *
     */
    public function actionBrowseInvitation()
    {
        $viewer = \App::authService()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $viewer->getId(),
            'parentType' => $viewer->getType(),
        ];

        $paging = \App::invitationService()
            ->loadInvitationPaging($query, $page);

        $lp = \App::layoutService()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'lp'      => $lp,
                'profile' => $viewer,
                'items'   => $paging,
            ]);
    }
}