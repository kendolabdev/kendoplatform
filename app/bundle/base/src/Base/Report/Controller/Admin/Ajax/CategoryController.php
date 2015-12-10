<?php
namespace Base\Report\Controller\Admin\Ajax;

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

        $cat = \App::reportService()->findCategoryById($id);

        if (!$cat)
            throw new \InvalidArgumentException("Could not find category");

        $cat->delete();

        \App::cacheService()
            ->flush();

        $this->response = [
            'directive' => 'close',
            'message'   => 'Saved changes.',
        ];

    }
}