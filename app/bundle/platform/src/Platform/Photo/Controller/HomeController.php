<?php
namespace Platform\Photo\Controller;

use Platform\Photo\Form\FilterAlbum;
use Platform\Photo\Form\FilterPhoto;
use Platform\Photo\Model\Photo;
use Platform\Photo\Model\PhotoAlbum;
use Platform\Photo\Service\PhotoService;
use Kendo\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Platform\Photo\Controller
 */
class HomeController extends DefaultController
{
    protected function _addPageButtons()
    {
        $btnPhoto = [
            'label' => \App::text('photo.upload_photos'),
            'icon'  => 'ion-plus',
            'props' => [
                'data-target' => '#upload-album-photo',
                'role'        => 'button',
                'class'       => 'btn btn-default btn-sm',
                'data-toggle' => 'btn-album-upload',
            ]
        ];

        $btnAlbum = [
            'label' => \App::text('photo.upload_photos'),
            'icon'  => 'ion-plus',
            'props' => [
                'data-target' => '#upload-new-album-photo',
                'role'        => 'button',
                'class'       => 'btn btn-default btn-sm',
                'data-toggle' => 'btn-album-upload',
            ],
        ];

        \App::layouts()
            ->setPageButtons([$btnAlbum, $btnPhoto]);
    }

    /**
     *
     */
    public function actionBrowsePhoto()
    {

        $filter = new FilterPhoto();

        \App::layouts()
            ->setupSecondaryNavigation('photo_main', null, 'photo_browse')
            ->setPageFilter($filter)
            ->setPageTitle('platform_photos');

        $this->_addPageButtons();

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::photoService()->loadPhotoPaging($query, $page);

        $paging->setRouting('photos', []);

        $lp = \App::layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/photo/photo/paging',
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

        \App::layouts()
            ->setupSecondaryNavigation('photo_main', null, 'photo_my')
            ->setPageTitle('photo.my_photos');;

        $this->_addPageButtons();

        $poster = \App::authService()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = \App::photoService()->loadPhotoPaging($query, $page);

        $paging->setRouting('photo_my', []);

        $lp = \App::layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/photo/photo/paging',
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

        \App::layouts()
            ->setupSecondaryNavigation('photo_main', null, 'photo_upload')
            ->setPageTitle('photo.upload_photos');;

        $this->_addPageButtons();

        $photoService = \App::photoService();

        $lp = \App::layouts()->getContentLayoutParams();

        if ($this->request->isPost()) {

            $fileIdList = $photoService->processPhotoUploadFromClient('photos', null);

            /**
             * create photo item from those
             */
            $poster = \App::authService()->getViewer();

            if (empty($fileIdList)) {

            } else {
                $photoService->addPhotos($fileIdList, $poster, [], true);
            }
        }

        $this->view->setScript($lp);
    }


    /**
     *
     */
    public function actionCreateAlbum()
    {

        \App::layouts()
            ->setupSecondaryNavigation('photo_main', null, 'create_album')
            ->setPageTitle('photo.create_album');;

        $poster = \App::authService()->getViewer();

        /**
         * init form
         */

        $form = \App::htmlService()->factory('\Photo\Form\CreateAlbum');

        $photoService = \App::photoService();

        if (!$photoService instanceof PhotoService) ;

        if (empty($parent)) {
            $parent = $poster;
        }

        /**
         * check post valid
         */

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            /**
             * get all data
             */
            $data = $form->getData();

            $fileList = \App::photoService()->processPhotoUploadFromClient('photos', null);

            $privacy = \App::relationService()->getRelationFromDataForSave($_POST, ['view', 'comment']);

            $album = $photoService->addAlbum($poster, $poster, array_merge($data, $privacy));

            if (!$album instanceof PhotoAlbum) {
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

        $lp = \App::layouts()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
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
        $filter = new FilterAlbum();

        \App::layouts()
            ->setupSecondaryNavigation('photo_main', null, 'browse_album')
            ->setPageFilter($filter)
            ->setPageTitle('photo.albums');

        $this->_addPageButtons();

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::photoService()->loadAlbumPaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/photo/album/paging',
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
        \App::layouts()
            ->setupSecondaryNavigation('photo_main', null, 'my_album')
            ->setPageTitle('photo.my_albums');

        $this->_addPageButtons();

        $page = $this->request->getParam('page', 1);
        $poster = \App::authService()->getViewer();

        $query = [
            'posterId'   => $poster->getId(),
            'posterType' => $poster->getType(),
        ];

        $paging = \App::photoService()->loadAlbumPaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/photo/album/paging',
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
        \App::layouts()
            ->setPageTitle('View Album');

        $this->_addPageButtons();

        $id = $this->request->getString('id');

        $album = \App::table('platform_photo_album')
            ->findById($id);

        if (!$album instanceof PhotoAlbum) {
            throw new \InvalidArgumentException("Album not found");
        }

        \App::assetService()
            ->setTitle($album->getTitle());

        \App::layouts()
            ->setPageTitle($album->getTitle());

        $page = $this->request->getParam('page', 1);

        $query = [
            'albumId' => $album->getId()
        ];

        $paging = \App::photoService()->loadPhotoPaging($query, $page);

        $lp = \App::layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/photo/photo/paging',
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

        $photo = \App::table('platform_photo')
            ->findById($id);

        $photoService = \App::photoService();

        if (!$photo instanceof Photo) {
            throw new \InvalidArgumentException("Photo not found");
        }

        $album = \App::find('platform_photo_album', $photo->getAlbumId());

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

        \App::registryService()->set('about', $photo);


        $mode = $this->request->getString('mode');

        if ($mode == 'spotlight') {
            \App::layouts()
                ->setPageName('photo_home_view_photo_spotlight');
        }

        $lp = \App::layouts()->getContentLayoutParams();

        if ($mode == 'spotlight') {
            $this->view->setScript($lp);
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

        $this->view->setScript($lp);
    }
}