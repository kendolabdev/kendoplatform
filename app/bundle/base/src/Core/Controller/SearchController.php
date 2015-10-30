<?php

namespace Core\Controller;

use Picaso\Controller\DefaultController;

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

        $lp = \App::layout()
            ->getContentLayoutParams();


        $this->view->setScript($lp->script())
            ->assign([]);
    }
}