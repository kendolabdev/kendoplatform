<?php
namespace Platform\Photo\Controller;

use Platform\Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Platform\Photo\Controller
 */
class ProfileController extends ProfileBaseController
{

    /**
     *
     */
    public function actionBrowsePhoto()
    {
        app()->layouts()
            ->setPageTitle('platform_photos');

        $profile = app()->registryService()->get('profile');

        $page = $this->request->getParam('page');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = app()->photoService()->loadPhotoPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/photo/photo/paging',
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
    public function actionViewAlbum()
    {
        $profile = app()->registryService()->get('profile');

        $albumId = $this->request->getParam('albumId');

        $album = app()->table('platform_photo_album')->findById($albumId);

        $page = $this->request->getParam('page', 1);

        $query = [
            'albumId'    => $album->getId(),
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = app()->photoService()->loadPhotoPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/photo/photo/paging',
                'profile'   => $profile,
                'paging'    => $paging,
                'album'     => $album,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }


    /**
     *
     */
    public function actionBrowseAlbum()
    {

        app()->layouts()
            ->setPageTitle('photo.albums');

        $profile = app()->registryService()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = app()->photoService()->loadAlbumPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/photo/album/paging',
                'paging'    => $paging,
                'profile'   => $profile,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }
}