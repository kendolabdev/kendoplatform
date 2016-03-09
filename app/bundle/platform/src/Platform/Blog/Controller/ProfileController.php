<?php
namespace Platform\Blog\Controller;

use Platform\Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Base\Blog\Controller
 */
class ProfileController extends ProfileBaseController
{

    /**
     *
     */
    public function actionBrowseBlog()
    {
        app()->layouts()
            ->setPageTitle('blog.blogs');

        $profile = app()->registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = app()->blogService()->loadPostPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/blog/post/paging',
                'paging'    => $paging,
                'query'     => $query,
                'pager'     => $paging->getPager(),
                'profile'   => $profile,
                'lp'        => $lp,
            ]);

    }
}