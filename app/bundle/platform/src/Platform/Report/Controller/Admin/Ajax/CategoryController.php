<?php
namespace Platform\Report\Controller\Admin\Ajax;

use Kendo\Controller\AjaxController;

/**
 * Class CategoryController
 *
 * @package Report\Controller\Admin\Ajax
 */
class CategoryController extends AjaxController
{
    /**
     *
     */
    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $cat = app()->reportService()->findCategoryById($id);

        if (!$cat)
            throw new \InvalidArgumentException("Could not find category");

        $cat->delete();

        app()->cacheService()
            ->flush();

        $this->response = [
            'directive' => 'close',
            'message'   => 'Saved changes.',
        ];

    }
}