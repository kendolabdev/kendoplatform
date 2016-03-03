<?php

namespace Platform\Core\Controller\Admin;

use Kendo\Controller\AdminController;

/**
 * Class InformationController
 *
 * @package Core\Controller\Admin
 */
class InformationController extends AdminController
{

    /**
     *
     */
    public function actionSystem()
    {
        $this->view->setScript('/platform/core/controller/admin/info/system');
    }

    /**
     *
     */
    public function actionServer()
    {
        $this->view->setScript('/platform/core/controller/admin/info/server');

    }
}