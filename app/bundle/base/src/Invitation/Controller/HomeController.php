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
        $viewer = \App::auth()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $viewer->getId(),
            'parentType' => $viewer->getType(),
        ];

        $paging = \App::invitation()
            ->loadInvitationPaging($query, $page);

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'lp'      => $lp,
                'profile' => $viewer,
                'items'   => $paging,
            ]);
    }
}