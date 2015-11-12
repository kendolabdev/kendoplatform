<?php
namespace Feed\Controller;

use Picaso\Controller\DefaultController;

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

        \App::registry()->set('activity_hashtag', $q);

        $lp = \App::layout()
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

        $poster = \App::auth()->getViewer();

        $options = ['feedIdList' => [$id]];

        $dataBundles = \App::feed()
            ->loadDataBundles($poster, null, false, $options);

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'bundles' => $dataBundles['bundles'],
            ]);
    }
}