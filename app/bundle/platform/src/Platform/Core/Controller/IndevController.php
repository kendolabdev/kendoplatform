<?php
namespace Platform\Core\Controller;

use Kendo\Controller\DefaultController;

class IndevController extends DefaultController
{

    public function actionIndex()
    {
        app()->assetService()
            ->requirejs()
            ->addDependency('primary/jquery.cropit')
            ->addScript('cropit', 'new CropIt(".cropit-container")');
        $this->view
            ->setScript('platform/core/controller/indev/test-avatar');
    }
}