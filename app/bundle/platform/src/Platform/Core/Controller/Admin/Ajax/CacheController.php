<?php
namespace Platform\Core\Controller\Admin\Ajax;

use Kendo\Controller\AjaxController;

/**
 * Class CacheController
 *
 * @package Core\Controller\Admin\Ajax
 */
class CacheController extends AjaxController
{

    public function actionClear()
    {
        app()->cacheService()
            ->flush();

        $this->response = [
            'directive' => 'reload',
            'success'   => 'Clear cache successfully!',
        ];
    }
}