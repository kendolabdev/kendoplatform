<?php
namespace Report\Controller\Admin\Ajax;

use Picaso\Controller\AjaxController;

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

        $cat = \App::report()->findCategoryById($id);

        if (!$cat)
            throw new \InvalidArgumentException("Could not find category");

        $cat->delete();

        \App::cache()
            ->flush();

        $this->response = [
            'directive' => 'close',
            'message'   => 'Saved changes.',
        ];

    }
}