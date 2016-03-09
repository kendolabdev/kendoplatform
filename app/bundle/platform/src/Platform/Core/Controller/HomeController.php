<?php

namespace Platform\Core\Controller;


use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Controller\DefaultController;
use Kendo\Controller\NotFoundException;

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

        $poster = app()->auth()->getViewer();

        app()->assetService()
            ->title()->set(app()->text('core.home_page'));

        if ($poster instanceof PosterInterface) {
            $this->request->forward(null, 'member');
        } else {
            app()->layouts()->setPageName('platform_core_home_index');
            $this->view->setScript('/platform/core/controller/home/index');
        }
    }

    /**
     *
     */
    public function actionMember()
    {
        $poster = app()->auth()->getViewer();

        if (!$poster instanceof PosterInterface) {
            return $this->request->forward(null, 'index');
        }

        app()->registryService()->set('profile', $poster);
        app()->layouts()->setPageName('platform_core_home_member');
        app()->registryService()->set('isMainFeed', true);
    }

    /**
     * @throws NotFoundException
     */
    public function actionRef()
    {
        $type = $this->request->getString('type');
        $id = $this->request->getString('id');

        $item = app()->find($type, $id);

        if (!$item instanceof ContentInterface) {
            throw new NotFoundException();
        }

        $this->request->redirectToUrl($item->toHref());
    }
}