<?php
namespace Platform\Photo\Controller\Ajax;

use Platform\Photo\Model\Photo;
use Kendo\Content\ContentInterface;
use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;

/**
 * Class FieldAvatarController
 *
 * @package Platform\Photo\Controller\Ajax
 */
class FieldAvatarController extends AjaxController
{
    /**
     * Show up edit avatar dialog
     */
    public function actionDialog()
    {
        list($type, $id) = $this->request->getList('type', 'id');

        $photo = null;
        $photoSrc = null;
        $data = [
            'photoSource' => '',
            'photoId'     => '',
            'fileId'      => '',
            'photoFileId' => '',
        ];

        if (!empty($type) && !empty($id)) {
            $photo = app()->find($type, $id);

            if (!$photo instanceof Photo)
                throw new \InvalidArgumentException(app()->text('photo.invalid_photo'));
        }

        if ($photo) {
            $photoSrc = $photo->getPhoto('origin');

            $data = [
                'photoSource' => $photoSrc,
                'photoFileId' => $photo->getPhotoFileId(),
                'photoId'     => $photo->getId(),
            ];
        }

        $lp = new BlockParams([
            'base_path' => 'platform/photo/dialog/field-avatar',
        ]);

        $this->response = [
            'html' => $this->partial($lp->script(), $data),
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
        $poster = app()->auth()->getViewer();
        $parent = app()->auth()->getViewer();
        $album = app()->photoService()->getSingletonAlbum($parent);

        if (!empty($cropit['photoId'])) {
            $photo = app()->find('photo', $cropit['photoId']);
        } else if (!empty($cropit['tempId'])) {

            $photoTemp = $cropit['tempId'];

            $fileId = app()->photoService()->processSinglePhotoUploadFromTemporary($photoTemp);

            $addParams = array_merge([], ['type' => 1, 'value' => 1]);

            $photo = app()->photoService()->addPhoto($fileId, $poster, $parent, $album, $addParams);
        }

        if (!$photo instanceof Photo)
            throw new \InvalidArgumentException(app()->text('photo.can_not_update_avatar'));

        $response = app()->photoService()->processAvatar($parent, $photo->getPhotoFileId(), $options);

        if (empty($response))
            throw new \InvalidArgumentException(app()->text('photo.can_not_update_avatar'));

        if ($poster instanceof ContentInterface) {
            $poster->setPhotoFileId($photo->getPhotoFileId());
            $poster->save();
        }

        $this->response['html'] = app()->storageService()->getUrlByOriginAndMaker($photo->getPhotoFileId(), 'avatar_md');
    }
}