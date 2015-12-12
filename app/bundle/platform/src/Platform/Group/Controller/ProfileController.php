<?php
namespace Platform\Group\Controller;

use Platform\Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Group\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function viewAbout()
    {

    }

    /**
     *
     */
    public function actionBrowseGroup()
    {
        \App::layoutService()
            ->setPageTitle('group.groups');

        $profile = \App::registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::groupService()->loadGroupPaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();


        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/group/group/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionBrowseMember()
    {
        $profile = \App::registryService()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::relationService()->loadMemberPaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/group/member/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'isOwner'   => $profile->viewerIsParent(),
                'lp'        => \App::layoutService()->getContentLayoutParams(),
            ]);
    }
}