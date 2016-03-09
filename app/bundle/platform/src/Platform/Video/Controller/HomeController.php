<?php
namespace Platform\Video\Controller;

use Kendo\Controller\DefaultController;
use Platform\Video\Form\Admin\FilterVideo;
use Platform\Video\Form\VideoFromUrl;
use Platform\Video\Model\Video;

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

        app()->layouts()
            ->setupSecondaryNavigation('video_main', null, 'video_browse')
            ->setPageFilter($filter)
            ->setPageTitle('video.videos');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = app()->videoService()->loadVideoPaging([], $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/video/video/paging',
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

        app()->layouts()
            ->setupSecondaryNavigation('video_main', null, 'video_my')
            ->setPageTitle('video.videos');

        $poster = app()->auth()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId()];

        $paging = app()->videoService()->loadVideoPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/video/video/paging',
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ]);

    }

    /**
     */
    public function actionEmbedVideo()
    {

        app()->layouts()
            ->setupSecondaryNavigation('video_main', null, 'video_embed')
            ->setPageTitle('video.videos');

        $form = new VideoFromUrl([]);

        $poster = app()->auth()->getViewer();
        $parent = $poster;

        $lp = app()->layouts()->getContentLayoutParams();

        if ($this->request->isPost()) {

            $form->setData($_POST);

            $data = $form->getData();

            $videoUrl = $data['videoUrl'];


            $result = app()->videoService()->parseFromUrl($videoUrl);

            $video = app()->videoService()->addVideo($poster, $parent, $result->toArray());

            if ($video) {

                app()->feedService()->addItemFeed('video_shared', $video);

                app()->routing()->redirect('videos');
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

        app()->layouts()
            ->setupSecondaryNavigation('video_main', null, 'video_create')
            ->setPageTitle('video.videos');

        $form = new VideoFromUrl([]);

        $poster = app()->auth()->getViewer();
        $parent = $poster;

        $lp = app()->layouts()->getContentLayoutParams();

        if ($this->request->isPost()) {
            $form->setData($_POST);

            $data = $form->getData();

            $videoUrl = $data['videoUrl'];

            $result = app()->videoService()->parseFromUrl($videoUrl);

            $video = app()->videoService()->addVideo($poster, $parent, $result->toArray());

            app()->feedService()->addItemFeed('video_shared', $video);

            app()->routing()->redirect('videos');

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

        $video = app()->videoService()->findVideo($id);

        if (!$video instanceof Video)
            throw new \InvalidArgumentException("Video not found");

        app()->assetService()
            ->setTitle($video->getTitle())
            ->setDescription($video->getDescription());

        app()->registryService()->set('about', $video);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'video'  => $video,
                'poster' => $video->getPoster(),
            ]);
    }
}