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
        \App::layouts()
            ->setPageTitle('blog.blogs');

        $profile = \App::registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::blogService()->loadPostPaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

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