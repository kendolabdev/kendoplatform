<?php
namespace Platform\Feed\Controller;

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

        app()->registryService()->set('activity_hashtag', $q);

        $lp = app()->layouts()
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

        $feed = app()->find('feed', $id);

        if (!$feed)
            throw new \InvalidArgumentException();

        $poster = app()->auth()->getViewer();

        $options = ['feedIdList' => [$id]];

        $dataBundles = app()->feedService()
            ->loadDataBundles($poster, null, false, $options);

        $lp = app()->layouts()
            ->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'bundles' => $dataBundles['bundles'],
            ]);
    }
}