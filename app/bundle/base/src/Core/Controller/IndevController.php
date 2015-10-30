<?php
namespace Core\Controller;

use Picaso\Controller\DefaultController;

class IndevController extends DefaultController
{

    public function actionIndex()
    {
        \App::assets()
            ->requirejs()
            ->addDependency('primary/jquery.cropit')
            ->addScript('cropit', 'new CropIt(".cropit-container")');
        $this->view
            ->setScript('base/core/controller/indev/test-avatar');
    }
}