<?php
namespace Group\Controller;

use Core\Controller\ProfileBaseController;

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
        \App::layout()
            ->setPageTitle('group.groups');

        $profile = \App::registry()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::group()->loadGroupPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();


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
        $profile = \App::registry()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::relation()->loadMemberPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/group/member/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'isOwner'   => $profile->viewerIsParent(),
                'lp'        => \App::layout()->getContentLayoutParams(),
            ]);
    }
}