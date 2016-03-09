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
        app()->layouts()
            ->setPageTitle('group.groups');

        $profile = app()->registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = app()->groupService()->loadGroupPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();


        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/group/group/paging',
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
        $profile = app()->registryService()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = app()->relation()->loadMemberPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/group/member/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'isOwner'   => $profile->viewerIsParent(),
                'lp'        => app()->layouts()->getContentLayoutParams(),
            ]);
    }
}