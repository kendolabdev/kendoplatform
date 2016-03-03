<?php
namespace Platform\Video\Controller;

use Platform\Core\Controller\ProfileBaseController;

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

        \App::layouts()
            ->setPageTitle('video.videos');

        $profile = \App::registryService()->get('profile');

        $page = $this->request->getParam('page');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        // paging group is belong to this owner.
        $paging = \App::videoService()->loadVideoPaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/video/video/paging',
                'paging'    => $paging,
                'query'     => $query,
                'profile'   => $profile,
                'lp'        => $lp,
            ]);
    }
}