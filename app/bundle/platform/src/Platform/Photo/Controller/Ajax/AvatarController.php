<?php
namespace Platform\Photo\Controller\Ajax;

use Platform\Photo\Model\Photo;
use Kendo\Content\ContentInterface;
use Kendo\Controller\AjaxController;

/**
 * Class AvatarController
 *
 * @package Platform\Photo\Controller\Ajax
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
            'html' => $this->partial('platform/photo/partial/edit-avatar-dialog', $data),
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
        $poster = \App::authService()->getViewer();
        $parent = \App::authService()->getViewer();
        $album = \App::photoService()->getSingletonAlbum($parent);

        if (!empty($cropit['photoId'])) {
            $photo = \App::find('photo', $cropit['photoId']);
        } else if (!empty($cropit['tempId'])) {

            $photoTemp = $cropit['tempId'];

            $fileId = \App::photoService()->processSinglePhotoUploadFromTemporary($photoTemp);

            $addParams = array_merge([], ['type' => 1, 'value' => 1]);

            $photo = \App::photoService()->addPhoto($fileId, $poster, $parent, $album, $addParams);
        }

        if (!$photo instanceof Photo)
            throw new \InvalidArgumentException(\App::text('photo.can_not_update_avatar'));

        $response = \App::photoService()->processAvatar($parent, $photo->getPhotoFileId(), $options);

        if (empty($response))
            throw new \InvalidArgumentException(\App::text('photo.can_not_update_avatar'));

        if ($poster instanceof ContentInterface) {
            $poster->setPhotoFileId($photo->getPhotoFileId());
            $poster->save();
        }

        $html = \App::storageService()->getUrlByOriginAndMaker($photo->getPhotoFileId(), 'avatar_md');

        $this->response = [
            'html'      => $html,
            'directive' => 'reload'
        ];
    }
}