<?php
namespace Blog\Controller;

use Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Blog\Controller
 */
class ProfileController extends ProfileBaseController
{

    /**
     *
     */
    public function actionBrowseBlog()
    {
        \App::layout()
            ->setPageTitle('blog.blogs');

        $profile = \App::registry()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::blog()->loadPostPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/blog/post/paging',
                'paging'    => $paging,
                'query'     => $query,
                'pager'     => $paging->getPager(),
                'profile'   => $profile,
                'lp'        => $lp,
            ]);

    }
}