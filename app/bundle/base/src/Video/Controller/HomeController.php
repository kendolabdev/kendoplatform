<?php
namespace Video\Controller;

use Picaso\Controller\DefaultController;
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

        \App::layout()
            ->setupSecondaryNavigation('video_main', null, 'video_browse')
            ->setPageTitle('video.videos');

        $page = $this->request->getParam('page', 1);

        $query = [];

        $paging = \App::video()->loadVideoPaging([], $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
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

        \App::layout()
            ->setupSecondaryNavigation('video_main', null, 'video_my')
            ->setPageTitle('video.videos');

        $poster = \App::auth()->getViewer();

        $page = $this->request->getParam('page', 1);

        $query = ['posterId' => $poster->getId()];

        $paging = \App::video()->loadVideoPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
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

        \App::layout()
            ->setupSecondaryNavigation('video_main', null, 'video_embed')
            ->setPageTitle('video.videos');

        $form = new VideoFromUrl([]);

        $poster = \App::auth()->getViewer();
        $parent = $poster;

        $lp = \App::layout()->getContentLayoutParams();

        if ($this->request->isPost()) {

            $form->setData($_POST);

            $data = $form->getData();

            $videoUrl = $data['videoUrl'];


            $result = \App::video()->parseFromUrl($videoUrl);

            $video = \App::video()->addVideo($poster, $parent, $result->toArray());

            if ($video) {

                \App::feed()->addItemFeed('video_shared', $video);

                \App::routing()->redirect('videos');
            }
        }

        $this->view->setScript($lp->script())
            ->assign([
                'form' => $form,
            ]);
    }

    /**
     *
     */
    public function actionUploadVideo()
    {

        \App::layout()
            ->setupSecondaryNavigation('video_main', null, 'video_create')
            ->setPageTitle('video.videos');

        $form = new VideoFromUrl([]);

        $poster = \App::auth()->getViewer();
        $parent = $poster;

        $lp = \App::layout()->getContentLayoutParams();

        if ($this->request->isPost()) {
            $form->setData($_POST);

            $data = $form->getData();

            $videoUrl = $data['videoUrl'];

            $result = \App::video()->parseFromUrl($videoUrl);

            $video = \App::video()->addVideo($poster, $parent, $result->toArray());

            \App::feed()->addItemFeed('video_shared', $video);

            \App::routing()->redirect('videos');

        }

        $this->view->setScript($lp->script())
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

        $video = \App::video()->findVideo($id);

        if (!$video instanceof Video)
            throw new \InvalidArgumentException("Video not found");

        \App::assets()
            ->setTitle($video->getTitle())
            ->setDescription($video->getDescription());

        \App::registry()->set('about', $video);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'video'  => $video,
                'poster' => $video->getPoster(),
            ]);
    }
}