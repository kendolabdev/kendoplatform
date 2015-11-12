<?php
namespace Core\Controller\Admin\Ajax;

use Core\Model\CoreExtension;
use Picaso\Controller\AjaxController;

/**
 * Class ExtensionController
 *
 * @package Core\Controller\Admin\Ajax
 */
class ExtensionController extends AjaxController
{

    /**
     *
     */
    public function actionExport()
    {
        $id = $this->request->getParam('id');

        $extension = \App::core()
            ->extension()
            ->findExensionById($id);

        try {
            if (!$extension instanceof CoreExtension)
                throw new \InvalidArgumentException("Invalid extension");

            \App::core()
                ->extension()
                ->export($extension);

            $this->response = [
                'directive' => 'success',
                'message'   => 'Exported ' . $extension->getTitle()
            ];


        } catch (\Exception $e) {
            $this->response = [
                'directive' => 'error',
                'message'   => $e->getMessage(),
            ];
        }


    }
}