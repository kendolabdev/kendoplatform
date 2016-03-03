<?php

namespace Platform\Core\Controller;

use Kendo\Controller\DefaultController;

/**
 * Class SearchController
 *
 * @package Core\Controller
 */
class SearchController extends DefaultController
{

    /**
     *
     */
    public function actionIndex()
    {

        $lp = \App::layouts()
            ->getContentLayoutParams();


        $this->view->setScript($lp)
            ->assign([]);
    }
}