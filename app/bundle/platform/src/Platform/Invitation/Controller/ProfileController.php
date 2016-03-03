<?php
namespace Platform\Invitation\Controller;

use Platform\Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Platform\Invitation\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function actionBrowseInvitation()
    {
        \App::layouts()
            ->setPageTitle('invitation.requests');

        $profile = \App::registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::invitationService()->loadInvitationPaging($query, $page);

        $lp = \App::layouts()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/invitation/invitation/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'lp'        => $lp,
            ]);
    }
}