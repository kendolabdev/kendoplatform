<?php

namespace Core\Controller;


use Picaso\Content\Content;
use Picaso\Controller\DefaultController;
use Picaso\Controller\NotFoundException;

/**
 * Class HomeController
 *
 * @package Core\Controller
 */
class HomeController extends DefaultController
{

    /**
     * Default front page controller
     */
    public function actionIndex()
    {

        $poster = \App::auth()->getViewer();

        \App::assets()
            ->title()->set(\App::text('core.home_page'));

        if ($poster) {
            \App::registry()->set('profile', $poster);
            \App::layout()->setPageName('core_member_home');
            \App::registry()->set('isMainFeed', true);
        } else {
            \App::layout()->setPageName('core_home');
        }

        $this->view->setScript('/base/core/controller/home/index');
    }

    /**
     * @throws NotFoundException
     */
    public function actionRef()
    {
        $type = $this->request->getString('type');
        $id = $this->request->getString('id');

        $item = \App::find($type, $id);

        if (!$item instanceof Content) {
            throw new NotFoundException();
        }

        \App::routing()->redirectToUrl($item->toHref());
    }
}