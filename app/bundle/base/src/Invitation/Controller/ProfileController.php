<?php
namespace Invitation\Controller;

use Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Invitation\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function actionBrowseInvitation()
    {
        \App::layout()
            ->setPageTitle('invitation.requests');

        $profile = \App::registry()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::invitation()->loadInvitationPaging($query, $page);

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/invitation/invitation/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'lp'        => $lp,
            ]);
    }
}