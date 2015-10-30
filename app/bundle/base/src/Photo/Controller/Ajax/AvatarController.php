<?php
namespace Photo\Controller\Ajax;

use Photo\Model\Photo;
use Picaso\Content\HasPhoto;
use Picaso\Controller\AjaxController;

/**
 * Class AvatarController
 *
 * @package Photo\Controller\Ajax
 */
class AvatarController extends AjaxController
{
    /**
     * Show up edit avatar dialog
     */
    public function actionEditAvatarDialog()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $photo = null;
        $photoSrc = null;
        $data = [
            'photoSource' => '',
            'photoId'     => '',
            'fileId'      => '',
            'photoFileId' => '',
        ];

        if (!empty($type) && !empty($id)) {
            $photo = \App::find($type, $id);

            if (!$photo instanceof Photo)
                throw new \InvalidArgumentException(\App::text('photo.invalid_photo'));
        }

        if ($photo) {
            $photoSrc = $photo->getPhoto('origin');

            $data = [
                'photoSource' => $photoSrc,
                'photoFileId' => $photo->getPhotoFileId(),
                'photoId'     => $photo->getId(),
            ];
        }


        $this->response = [
            'html' => $this->partial('base/photo/partial/edit-avatar-dialog', $data),
        ];
    }

    /**
     *
     */
    public function actionUpdateAvatar()
    {
        $cropit = $this->request->getParam('cropit');

        list($w1, $h1, $w2, $h2, $x, $y) = explode(',', $cropit['options']);

        $options = [
            'w1' => $w1,
            'h1' => $h1,
            'w2' => $w2,
            'h2' => $h2,
            'x'  => $x,
            'y'  => $y,
        ];

        $photo = null;
        $poster = \App::auth()->getViewer();
        $parent = \App::auth()->getViewer();
        $album = \App::photo()->getSingletonAlbum($parent);

        if (!empty($cropit['photoId'])) {
            $photo = \App::find('photo', $cropit['photoId']);
        } else if (!empty($cropit['tempId'])) {

            $photoTemp = $cropit['tempId'];

            $fileId = \App::photo()->processSinglePhotoUploadFromTemporary($photoTemp);

            $addParams = array_merge([], ['type' => 1, 'value' => 1]);

            $photo = \App::photo()->addPhoto($fileId, $poster, $parent, $album, $addParams);
        }

        if (!$photo instanceof Photo)
            throw new \InvalidArgumentException(\App::text('photo.can_not_update_avatar'));

        $response = \App::photo()->processAvatar($parent, $photo->getPhotoFileId(), $options);

        if (empty($response))
            throw new \InvalidArgumentException(\App::text('photo.can_not_update_avatar'));

        if ($poster instanceof HasPhoto) {
            $poster->setPhotoFileId($photo->getPhotoFileId());
            $poster->save();
        }

        $this->response['html'] = \App::storage()->getUrlByOriginAndMaker($photo->getPhotoFileId(), 'avatar_md');
    }
}