<?php

namespace Platform\Core\Controller\Ajax;

use Kendo\Controller\AjaxController;

/**
 * Class AjaxErrorController
 *
 * @package Platform\Core\Controller\Ajax
 */
class ErrorController extends AjaxController
{

    /**
     *
     */
    public function actionException()
    {
        $e = $this->request->getException();

        $this->response = [
            'code'    => $e->getCode(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'message' => $e->getMessage(),
        ];
    }
}


