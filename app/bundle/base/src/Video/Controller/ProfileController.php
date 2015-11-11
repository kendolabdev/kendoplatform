<?php
namespace Video\Controller;

use Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Video\Controller
 */
class ProfileController extends ProfileBaseController
{

    /**
     *
     */
    public function actionBrowseVideo()
    {

        \App::layout()
            ->setPageTitle('video.videos');

        $profile = \App::registry()->get('profile');

        $page = $this->request->getParam('page');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        // paging group is belong to this owner.
        $paging = \App::video()->loadVideoPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/video/video/paging',
                'paging'    => $paging,
                'query'     => $query,
                'profile'   => $profile,
                'lp'        => $lp,
            ]);
    }
}