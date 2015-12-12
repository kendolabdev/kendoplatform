<?php
namespace Platform\Photo\Controller\Ajax;

use Platform\Feed\Model\Feed;
use Platform\Photo\Model\Album;
use Platform\Photo\Model\Photo;
use Platform\Photo\Model\PhotoAlbum;
use Kendo\Acl\AuthorizationRestrictException;
use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;

/**
 * Class Platform\PhotoController
 *
 * @package Platform\Photo\Controller\Ajax
 */
class PhotoController extends AjaxController
{

    public function actionMakeAlbumCover()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $photo = \App::find($type, $id);

        if (!$photo instanceof Photo)
            throw new \InvalidArgumentException(\App::text('photo.invalid_photo'));

        \App::photoService()->makeAlbumCover($photo);

        $this->response = [
            'html'    => '',
            'message' => \App::text('photo.photo_is_set_to_album_cover'),
        ];
    }

    public function actionPhotoOptions()
    {

        $type = 'photo';

        list($id, $eid) = $this->request->get('photoId', 'eid');

        $item = \App::find($type, $id);

        $data = [
            'eid'    => $eid,
            'item'   => $item,
            'viewer' => \App::authService()->getViewer()
        ];

        $this->response = [
            'html' => $this->partial('base/photo/partial/photo-options', $data),
        ];
    }

    /**
     * Submit photos to album or create new album & upload photos.
     */
    public function actionSubmitPhotos()
    {
        list($albumId, $photoTemp) = $this->request->get('album_id', 'photoTemp');
        list($albumName, $albumDesc, $newAlbum, $context) = $this->request->get('name', 'description', 'new_album', 'context');

        $photoService = \App::photoService();

        $album = null;
        $parent = null;
        $poster = null;

        $poster = \App::authService()->getViewer();

        if (null == $parent) {
            $parent = $poster;
        }

        $privacy = \App::relationService()->getRelationFromDataForSave($_POST, ['view', 'comment']);

        if ($newAlbum) {
            $album = \App::photoService()->addAlbum($poster, $parent, array_merge([
                'name'        => $albumName,
                'description' => $albumDesc,
            ], $privacy));
        }

        if (!$album && $albumId) {
            $album = $photoService->findAlbumById($albumId);
        }

        if (!$album) {
            $album = $photoService->getSingletonAlbum($parent);
        }

        if (!$album instanceof PhotoAlbum) {
            throw new \InvalidArgumentException("Invalid Album");
        }

        /**
         * add album to photo
         */

        $fileIdList = $photoService->processPhotoUploadFromTemporary($photoTemp, null);

        $addParams = array_merge([], $privacy);

        $addResult = $photoService->addPhotos($fileIdList, $poster, $parent, $album, $addParams, true);

        list($totalPhoto, $photoList, $album, $collection, $feed) = $addResult;

        $feedId = 0;

        if ($feed instanceof Feed) {
            $feedId = $feed->getId();
        }

        /**
         * Create feed
         */
        $this->response = [
            'context'    => $context,
            'feed'       => $feedId,
            'totalPhoto' => $totalPhoto,
            'album'      => ['id' => $album->getId(), 'title' => $album->getTitle(), 'type' => $album->getType()],
        ];

    }

    /**
     * @return \Kendo\Html\HtmlElement
     */
    private function createAlbumSelectField()
    {
        $posterId = \App::authService()->getId();

        $albums = \App::table('photo.photo_album')
            ->select()
            ->where('parent_id=?', (string)$posterId)
            ->all();

        $options = [];

        foreach ($albums as $album) {
            if (!$album instanceof PhotoAlbum) continue;
            $options[] = ['value' => $album->getId(), 'label' => $album->getTitle()];
        }

        if (empty($options)) {
            $album = \App::photoService()->getSingletonAlbum(\App::authService()->getViewer());
            $options[] = ['value' => $album->getId(), 'label' => $album->getTitle()];
        }

        $albumSelect = \App::htmlService()->create([
            'plugin'   => 'select',
            'name'     => 'album_id',
            'required' => true,
            'label'    => 'Select Album',
            'options'  => $options,
            'value'    => 0
        ]);

        return $albumSelect;
    }

    /**
     * Show upload modal
     */
    public function actionUploadPhotoDialog()
    {
        /**
         * Create select album form for current poster
         */

        list($albumId, $formMode, $context) = $this->request->get('albumId', 'mode', 'context');

        $albumSelect = null;
        $album = null;
        $modalTitle = \App::text('photo.upload');

        // crate album select
        if (!$albumId) {
            $albumSelect = $this->createAlbumSelectField();
        }

        if ($albumId) {
            $album = \App::photoService()->findAlbumById($albumId);

            if ($album instanceof PhotoAlbum) {
//                $modalTitle = $album->getTitle();
            }
        }

        $formAlbum = \App::htmlService()->factory('\Photo\Form\CreateAlbum', []);

        if ($formAlbum->hasElement('photos')) {
            $formAlbum->removeElement('photos');
        }

        /**
         * fix issue could not submit form in chrome
         * An invalid form control with name='name' is not focusable
         */
        if ($formAlbum->hasElement('name')) {
            $formAlbum->getElement('name')
                ->setRequired(false);
        }

        $shouldSelectAlbum = empty($albumId) && empty($formMode);
        $shouldCreateAlbum = empty($albumId);
        $useNewAlbum = null;

        $label1 = \App::text('photo.new_album');
        $label0 = \App::text('photo.select_album');

        if (empty($formMode)) $formMode = 0;

        $label = $formMode == 1 ? $label0 : $label1;

        $useNewAlbum = $formMode == 1 ? 1 : 0;

        $data = [
            'formAlbum'         => $formAlbum,
            'albumSelect'       => $albumSelect,
            'albumId'           => $albumId,
            'modalTitle'        => $modalTitle,
            'shouldCreateAlbum' => $shouldCreateAlbum,
            'shouldSelectAlbum' => $shouldSelectAlbum,
            'formMode'          => $formMode,
            'label1'            => $label1,
            'label0'            => $label0,
            'label'             => $label,
            'useNewAlbum'       => $useNewAlbum,
            'context'           => $context,
        ];

        $this->response = [
            'html' => $this->partial('base/photo/partial/upload-photo-dialog', $data),
        ];
    }

    /**
     *
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = \App::photoService()->loadPhotoPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $html = $this->partial($lp->itemScript(), [
            'paging' => $paging,
            'lp'     => $lp
        ]);

        $this->response = [
            'html'    => $html,
            'pager'   => $paging->getPager(),
            'query'   => $query,
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
        ];
    }

    /**
     * Delete photo
     */
    public function actionDeletePhoto()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $photo = \App::find($type, $id);

        /**
         * parent and poster can delete
         */

        if (!$photo instanceof Photo)
            throw new \InvalidArgumentException("Not photo");

        if (!$photo->viewerIsPosterOrParent())
            throw new AuthorizationRestrictException("You don't have permission to delete this photo");

        if (!\App::aclService()->authorize('photo__delete'))
            throw new AuthorizationRestrictException("You don't have permission to delete this photo");


        $photo->delete();


        $this->response = [
            'message' => \App::text('photo.photo_is_deleted'),
        ];
    }
}