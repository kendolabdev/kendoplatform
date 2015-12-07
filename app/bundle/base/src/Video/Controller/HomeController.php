<?php
namespace Video\Controller;

use Kendo\Controller\DefaultController;
use Video\Form\Admin\FilterVideo;
use Video\Form\VideoFromUrl;
use Video\Model\Video;

/**
 * Class HomeController
 *
 * @package Video\Controller
 */
class HomeController extends DefaultController
{
    /**
     *
     */
    public function actionBrowseVideo()
    {

        $filter = new FilterVideo();

        \App::layoutService()
            ->setupSecondaryNavigation('video_main', null, 'video_browse')
            ->setPageFilter($filter)
            ->setPageTitle('video.videos');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::videoService()->loadVideoPaging([], $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/video/video/paging',
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ]);

    }

    /**
     *
     */
    public function actionMyVideo()
    {

        \App::layoutService()
            ->setupSecondaryNavigation('video_main', null, 'video_my')
            ->setPageTitle('video.videos');

        $poster = \App::authService()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId()];

        $paging = \App::videoService()->loadVideoPaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/video/video/paging',
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ]);

    }

    /**
     */
    public function actionEmbedVideo()
    {

        \App::layoutService()
            ->setupSecondaryNavigation('video_main', null, 'video_embed')
            ->setPageTitle('video.videos');

        $form = new VideoFromUrl([]);

        $poster = \App::authService()->getViewer();
        $parent = $poster;

        $lp = \App::layoutService()->getContentLayoutParams();

        if ($this->request->isPost()) {

            $form->setData($_POST);

            $data = $form->getData();

            $videoUrl = $data['videoUrl'];


            $result = \App::videoService()->parseFromUrl($videoUrl);

            $video = \App::videoService()->addVideo($poster, $parent, $result->toArray());

            if ($video) {

                \App::feedService()->addItemFeed('video_shared', $video);

                \App::routingService()->redirect('videos');
            }
        }

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }

    /**
     *
     */
    public function actionUploadVideo()
    {

        \App::layoutService()
            ->setupSecondaryNavigation('video_main', null, 'video_create')
            ->setPageTitle('video.videos');

        $form = new VideoFromUrl([]);

        $poster = \App::authService()->getViewer();
        $parent = $poster;

        $lp = \App::layoutService()->getContentLayoutParams();

        if ($this->request->isPost()) {
            $form->setData($_POST);

            $data = $form->getData();

            $videoUrl = $data['videoUrl'];

            $result = \App::videoService()->parseFromUrl($videoUrl);

            $video = \App::videoService()->addVideo($poster, $parent, $result->toArray());

            \App::feedService()->addItemFeed('video_shared', $video);

            \App::routingService()->redirect('videos');

        }

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }

    /**
     *
     */
    public function actionViewVideo()
    {
        $id = $this->request->getString('id');

        $video = \App::videoService()->findVideo($id);

        if (!$video instanceof Video)
            throw new \InvalidArgumentException("Video not found");

        \App::assetService()
            ->setTitle($video->getTitle())
            ->setDescription($video->getDescription());

        \App::registryService()->set('about', $video);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'video'  => $video,
                'poster' => $video->getPoster(),
            ]);
    }
}