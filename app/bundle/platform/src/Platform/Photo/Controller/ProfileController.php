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
        \App::layouts()
            ->setPageTitle('platform_photos');

        $profile = \App::registryService()->get('profile');

        $page = $this->request->getParam('page');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::photoService()->loadPhotoPaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

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
        $profile = \App::registryService()->get('profile');

        $albumId = $this->request->getParam('albumId');

        $album = \App::table('platform_photo_album')->findById($albumId);

        $page = $this->request->getParam('page', 1);

        $query = [
            'albumId'    => $album->getId(),
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::photoService()->loadPhotoPaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

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

        \App::layouts()
            ->setPageTitle('photo.albums');

        $profile = \App::registryService()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::photoService()->loadAlbumPaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

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