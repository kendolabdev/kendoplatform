<?php
namespace Feed\Controller;

use Kendo\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Feed\Controller
 */
class HomeController extends DefaultController
{
    /**
     * Filter activity stream by hashtag
     */
    public function actionHashtag()
    {
        $q = $this->request->getParam('q');

        \App::registryService()->set('activity_hashtag', $q);

        $lp = \App::layoutService()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp);
    }

    /**
     * view feed detail
     */
    public function actionViewFeed()
    {

        $id = $this->request->getParam('id');

        $feed = \App::find('feed', $id);

        if (!$feed)
            throw new \InvalidArgumentException();

        $poster = \App::authService()->getViewer();

        $options = ['feedIdList' => [$id]];

        $dataBundles = \App::feedService()
            ->loadDataBundles($poster, null, false, $options);

        $lp = \App::layoutService()
            ->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'bundles' => $dataBundles['bundles'],
            ]);
    }
}