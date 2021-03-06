<?php
namespace Platform\Follow\Controller;

use Platform\Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Follow\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function actionBrowseFollower()
    {
        app()->layouts()
            ->setPageTitle('follow.followers');

        $profile = app()->registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = app()->followService()->loadFollowPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/feed/follower/paging',
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
    public function actionBrowseFollowing()
    {
        app()->layouts()
            ->setPageTitle('follow.following');

        $profile = app()->registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'posterId'   => $profile->getId(),
            'posterType' => $profile->getType(),
        ];

        $paging = app()->followService()->loadFollowPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/feed/following/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'lp'        => $lp,
            ]);

    }
}