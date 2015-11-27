<?php

namespace Core\Controller;


use Picaso\Content\Content;
use Picaso\Content\Poster;
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

        $poster = \App::authService()->getViewer();

        \App::assetService()
            ->title()->set(\App::text('core.home_page'));

        if ($poster instanceof Poster) {
            return $this->forward(null, 'member');
        } else {
            \App::layoutService()->setPageName('core_home_index');
            $this->view->setScript('/base/core/controller/home/index');
        }
    }

    /**
     *
     */
    public function actionMember()
    {
        $poster = \App::authService()->getViewer();

        if (!$poster instanceof Poster) {
            return $this->forward(null, 'index');
        }

        \App::registryService()->set('profile', $poster);
        \App::layoutService()->setPageName('core_home_member');
        \App::registryService()->set('isMainFeed', true);
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

        \App::routingService()->redirectToUrl($item->toHref());
    }
}