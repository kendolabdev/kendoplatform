<?php

namespace Platform\Invitation\Controller;

use Kendo\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Platform\Invitation\Controller
 */
class HomeController extends DefaultController
{

    /**
     *
     */
    public function actionBrowseInvitation()
    {
        $viewer = app()->auth()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $viewer->getId(),
            'parentType' => $viewer->getType(),
        ];

        $paging = app()->invitationService()
            ->loadInvitationPaging($query, $page);

        $lp = app()->layouts()
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