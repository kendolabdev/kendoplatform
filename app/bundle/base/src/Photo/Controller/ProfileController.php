<?php
namespace Photo\Controller;

use Core\Controller\ProfileBaseController;

/**
 * Class ProfileController
 *
 * @package Photo\Controller
 */
class ProfileController extends ProfileBaseController
{

    /**
     *
     */
    public function actionBrowsePhoto()
    {
        $profile = \App::registry()->get('profile');

        $page = $this->request->getParam('page');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::photo()->loadPhotoPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/photo/paging',
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
        $profile = \App::registry()->get('profile');

        $albumId = $this->request->getParam('albumId');

        $album = \App::table('photo.photo_album')->findById($albumId);

        $page = $this->request->getParam('page', 1);

        $query = [
            'albumId'    => $album->getId(),
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $paging = \App::photo()->loadPhotoPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/photo/paging',
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
        $profile = \App::registry()->get('profile');

        $query = [
            'parentId'   => $profile->getId(),
            'parentType' => $profile->getType(),
        ];

        $page = $this->request->getParam('page', 1);

        $paging = \App::photo()->loadAlbumPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/album/paging',
                'paging'    => $paging,
                'profile'   => $profile,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }
}