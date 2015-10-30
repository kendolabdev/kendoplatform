<?php
namespace Help\Controller;

use Picaso\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Help\Controller
 */
class HomeController extends DefaultController
{

    /**
     * Override this method to allow guest access connect method
     *
     * @return bool
     */
    protected function passNetworkBrowseMode()
    {
        return true;
    }

    /**
     *
     */
    public function actionTerms()
    {
        $this->view
            ->setScript('base/core/controller/help/view-terms')
            ->assign([]);
    }

    /**
     *
     */
    public function actionPrivacy()
    {
        $this->view
            ->setScript('base/core/controller/help/view-privacy')
            ->assign([]);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $query = ['active' => 1];

        $page = $this->request->getParam('page', 1);

        $paging = \App::help()
            ->loadCategoryPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->setData([
                'pagingUrl' => 'ajax/help/category/paging',
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }


    /**
     *
     */
    public function actionViewCategory()
    {
        $slug = $this->request->getParam('category');

        $category = \App::help()
            ->findCategory($slug);

        $query = ['category' => $category->getId()];

        $paging = \App::help()
            ->loadTopicPaging($query, $page = 1, $limit = 10);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script())
            ->assign([
                'category'  => $category,
                'paging'    => $paging,
                'lp'        => $lp,
                'query'     => 'query',
                'pagingUrl' => 'ajax/help/topic/paging',
            ]);
    }

    /**
     *
     */
    public function actionViewTopic()
    {
        $slug = $this->request->getParam('topic');

        $topic = \App::help()
            ->findTopic($slug);

        $lp = \App::layout()->getContentLayoutParams();

        $query = [
            'topic' => $topic->getId(),
        ];

        $paging = \App::help()
            ->loadPostPaging($query, $page = 1, $limit = 10);


        $this->view->setScript($lp->script())
            ->assign([
                'topic'     => $topic,
                'paging'    => $paging,
                'lp'        => $lp,
                'query'     => $query,
                'pagingUrl' => 'ajax/help/post/paging'
            ]);
    }

    /**
     *
     */
    public function actionViewPost()
    {
        $slug = $this->request->getParam('post');

        $post = \App::help()->findPost($slug);

        if (!$post) {
            $this->forward(null, 'index');

            return;
        }

        $lp = \App::layout()->getContentLayoutParams();

        $topic = $post->getTopic();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'lp'    => $lp,
                'item'  => $post,
                'topic' => $topic,
            ]);
    }

    public function actionViewPage()
    {
        $slug = $this->request->getParam('page');

        $page = \App::help()
            ->findPage($slug);

        if (!$page)
            return $this->forward(null, 'index');

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign(['item' => $page]);
    }

    /**
     * view post
     */
    public function actionView()
    {
        list($categoryId, $topicId, $postId) = $this->request->get('category', 'topic', 'post');


        if (empty($categoryId))
            return $this->forward(null, 'index');

        if (empty($topicId))
            return $this->forward(null, 'view-category');

        if (empty($postId))
            return $this->forward(null, 'view-topic');

        return $this->forward(null, 'view-post');
    }
}