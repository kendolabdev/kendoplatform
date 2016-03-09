<?php
namespace Platform\Photo\Controller\Ajax;

use Kendo\Content\AtomInterface;
use Kendo\Controller\AjaxController;

/**
 * Class CoverController
 *
 * @package Core\Controller\Ajax
 */
class CoverController extends AjaxController
{

    public function actionRemove()
    {

        $parent = $this->request->getArray('parent');

        $parent = app()->find($parent['type'], $parent['id']);

        if (!$parent instanceof AtomInterface) {
            throw new \InvalidArgumentException("Could not set cover for current subject");
        }

        $poster = app()->auth()->getViewer();

        app()->photoService()->removeCover($parent);

        $this->response = [];
    }

    /**
     *
     */
    public function actionSave()
    {

        $fileId = $this->request->getParam('fileId');
        $uploaded = $this->request->getParam('uploaded', 0);
        $parent = $this->request->getParam('parent');
        $positionTop = $this->request->getInt('top', 0);

        $parent = app()->find($parent['type'], $parent['id']);

        if (!$parent instanceof AtomInterface) {
            throw new \InvalidArgumentException("Could not set cover for current subject");
        }

        $poster = app()->auth()->getViewer();

        if (!$parent)
            throw new \InvalidArgumentException("Could not find parent");


        $photoService = app()->photoService();

        if ($fileId) {
            $album = $photoService->getSingletonAlbum($parent);

            if ($uploaded) {
                $fileId = app()->photoService()->processSinglePhotoUploadFromTemporary($fileId);

                $photo = $photoService->addPhoto($fileId, $poster, $parent, $album, $params = []);
                $photoService->setCover($parent, $photo, $positionTop);
            } else {
                $photo = $photoService->addPhoto($fileId, $poster, $parent, $album, $params = []);
                $photoService->setCover($parent, $photo, $positionTop);
            }
        } else {
            $photoService->updatePosition($parent, $positionTop);
        }

        /**
         * create photo from file
         */


        // how to process uploaded photo from temporary data

        $this->response = [
            'url'     => $parent->toHref(),
            'message' => app()->text('photo.profile_cover_is_updated')
        ];
    }
}