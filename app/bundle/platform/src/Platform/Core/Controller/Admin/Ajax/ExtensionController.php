<?php
namespace Platform\Core\Controller\Admin\Ajax;

use Platform\Core\Model\CoreExtension;
use Kendo\Controller\AjaxController;

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

        $extension = app()->coreService()
            ->extension()
            ->findExensionById($id);

        try {
            if (!$extension instanceof CoreExtension)
                throw new \InvalidArgumentException("Invalid extension");

            app()->coreService()
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