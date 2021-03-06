<?php
namespace Platform\Photo\Controller\Ajax;

use Kendo\Controller\AjaxController;

/**
 * Class UploadController
 *
 * @package Platform\Photo\Controller\Ajax
 */
class UploadController extends AjaxController
{
    /**
     * upload temporary
     */
    public function actionTemp()
    {

        $inputFile = app()->storageService()->getUploadFile('fileUpload', ['accepts' => 'photo']);

        $temp = app()->storageService()->saveToTemporary($inputFile);

        $this->response = [
            'id'         => $temp->getId(),
            'path'       => $temp->getPath(),
            'url'        => $temp->getUrl(),
            'type'       => $temp->getType(),
            'size'       => $temp->getSize(),
            'name'       => $temp->getName(),
            'created_at' => $temp->getCreatedAt(),
        ];
    }
}