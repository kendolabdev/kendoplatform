<?php
namespace Base\Like\Controller;

use Platform\Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Like\Controller
 */
class ProfileController extends ProfileBaseController
{
    /**
     *
     */
    public function actionBrowseLike()
    {
        $profile = \App::registryService()->get('profile');

        $page = $this->request->getParam('page', 1);

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::likeService()->loadLikePaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/like/like/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'profile'   => $profile,
                'lp'        => $lp,
            ]);
    }
}