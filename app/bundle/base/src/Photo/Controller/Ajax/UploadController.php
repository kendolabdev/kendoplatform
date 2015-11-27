<?php
namespace Photo\Controller\Ajax;

use Picaso\Controller\AjaxController;

/**
 * Class UploadController
 *
 * @package Photo\Controller\Ajax
 */
class UploadController extends AjaxController
{
    /**
     * upload temporary
     */
    public function actionTemp()
    {

        $inputFile = \App::storageService()->getUploadFile('fileUpload', ['accepts' => 'photo']);

        $temp = \App::storageService()->saveToTemporary($inputFile);

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