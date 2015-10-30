<?php
namespace Photo\Controller;

use Photo\Model\Album;
use Photo\Model\Photo;
use Photo\Service\PhotoService;
use Picaso\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Photo\Controller
 */
class HomeController extends DefaultController
{
    /**
     *
     */
    public function actionBrowsePhoto()
    {
        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::photo()->loadPhotoPaging($query, $page);

        $paging->setRouting('photos', []);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/photo/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionMyPhoto()
    {
        $poster = \App::auth()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = \App::photo()->loadPhotoPaging($query, $page);

        $paging->setRouting('photo_my', []);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/photo/paging',
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionUploadPhoto()
    {
        $photoService = \App::photo();

        $lp = \App::layout()->getContentLayoutParams();

        if ($this->request->isPost()) {

            $fileIdList = $photoService->processPhotoUploadFromClient('photos', null);

            /**
             * create photo item from those
             */
            $poster = \App::auth()->getViewer();

            if (empty($fileIdList)) {

            } else {
                $photoService->addPhotos($fileIdList, $poster, [], true);
            }
        }

        $this->view->setScript($lp->script());
    }


    /**
     *
     */
    public function actionCreateAlbum()
    {
        $poster = \App::auth()->getViewer();

        /**
         * init form
         */

        $form = \App::html()->factory('\Photo\Form\CreateAlbum');

        $photoService = \App::service('photo');

        if (!$photoService instanceof PhotoService) ;

        if (empty($parent)) {
            $parent = $poster;
        }

        /**
         * check post valid
         */

        if ($this->request->isPost() && $form->isValid($_POST)) {
            /**
             * get all data
             */
            $data = $form->getData();

            $fileList = \App::photo()->processPhotoUploadFromClient('photos', null);

            $privacy = \App::relation()->getRelationFromDataForSave($_POST, ['view', 'comment']);

            $album = $photoService->addAlbum($poster, $poster, array_merge($data, $privacy));

            if (!$album instanceof Album) {
                throw new \InvalidArgumentException();
            }

            $addParams = [];

            $photoService->addPhotos($fileList, $poster, $parent, $album, $addParams, true);

            /**
             * go to albums list
             */
            if ($album) {
                \App::routing()->redirect('album_my');
            }
        }

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'profile' => $poster,
                'form'    => $form,
            ]);
    }

    /**
     * Browse public albums
     */
    public function actionBrowseAlbum()
    {
        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::photo()->loadAlbumPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/album/paging',
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionMyAlbum()
    {
        $page = $this->request->getParam('page', 1);
        $poster = \App::auth()->getViewer();

        $query = [
            'posterId'   => $poster->getId(),
            'posterType' => $poster->getType(),
        ];

        $paging = \App::photo()->loadAlbumPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/album/paging',
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     * View album
     */
    public function actionViewAlbum()
    {
        $id = $this->request->getString('id');

        $album = \App::table('photo.photo_album')
            ->findById($id);

        if (!$album instanceof Album) {
            throw new \InvalidArgumentException("Album not found");
        }

        \App::assets()
            ->setTitle($album->getTitle());

        $page = $this->request->getParam('page', 1);

        $query = [
            'albumId' => $album->getId()
        ];

        $paging = \App::photo()->loadPhotoPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/photo/photo/paging',
                'paging'    => $paging,
                'album'     => $album,
                'poster'    => $album->getPoster(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     * View photo detail
     */
    public function actionViewPhoto()
    {

        $id = $this->request->getString('id');

        $photo = \App::table('photo')
            ->findById($id);

        $photoService = \App::photo();

        if (!$photo instanceof Photo) {
            throw new \InvalidArgumentException("Photo not found");
        }

        $album = \App::find('photo.photo_album', $photo->getAlbumId());

        $poster = $photo->getPoster();

        $context = $this->request->getString('context');

        $nextPhoto = $photoService->nextPhoto($photo, $context);
        $prevPhoto = $photoService->prevPhoto($photo, $context);
        $currentUrl = $photo->toHref(['context' => $context]);

        $nextUrl = null;
        $prevUrl = null;

        if ($nextPhoto) {
            $nextUrl = $nextPhoto->toHref(['context' => $context]);
        }

        if ($prevPhoto) {
            $prevUrl = $prevPhoto->toHref(['context' => $context]);
        }

        $this->view->assign([
            'album'      => $album,
            'poster'     => $poster,
            'photo'      => $photo,
            'nextUrl'    => $nextUrl,
            'prevUrl'    => $prevUrl,
            'nextPhoto'  => $nextPhoto,
            'prevPhoto'  => $prevPhoto,
            'currentUrl' => $currentUrl,
        ]);

        \App::registry()->set('about', $photo);


        $mode = $this->request->getString('mode');

        if ($mode == 'spotlight') {
            \App::layout()
                ->setPageName('photo_home_view_photo_spotlight');
        }

        $lp = \App::layout()->getContentLayoutParams();

        if ($mode == 'spotlight') {
            $this->view->setScript($lp->script());
            $html = $this->view->render();

            $photoSrc = $photo->getPhoto('origin');

            list($width, $height) = getimagesize($photoSrc);

            echo json_encode([
                'html'  => $html,
                'image' => [
                    'url'    => $photoSrc,
                    'width'  => $width,
                    'height' => $height,
                ]
            ]);

            exit;
        }

        $this->view->setScript($lp->script());
    }
}