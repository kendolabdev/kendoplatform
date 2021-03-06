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

        app()->layouts()
            ->setPageTitle('video.videos');

        $profile = app()->registryService()->get('profile');

        $page = $this->request->getParam('page');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        // paging group is belong to this owner.
        $paging = app()->videoService()->loadVideoPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

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