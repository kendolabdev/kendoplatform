<?php
namespace Platform\Help\Controller;

use Kendo\Controller\DefaultController;

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
            ->setScript('platform/core/controller/help/view-terms')
            ->assign([]);
    }

    /**
     *
     */
    public function actionPrivacy()
    {
        $this->view
            ->setScript('platform/core/controller/help/view-privacy')
            ->assign([]);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $query = ['active' => 1];

        $page = $this->request->getParam('page', 1);

        $paging = app()->helpService()
            ->loadCategoryPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->setData([
                'pagingUrl' => 'ajax/platform/help/category/paging',
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

        $category = app()->helpService()
            ->findCategory($slug);

        $query = ['category' => $category->getId()];

        $paging = app()->helpService()
            ->loadTopicPaging($query, $page = 1, $limit = 10);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'category'  => $category,
                'paging'    => $paging,
                'lp'        => $lp,
                'query'     => 'query',
                'pagingUrl' => 'ajax/platform/help/topic/paging',
            ]);
    }

    /**
     *
     */
    public function actionViewTopic()
    {
        $slug = $this->request->getParam('topic');

        $topic = app()->helpService()
            ->findTopic($slug);

        $lp = app()->layouts()->getContentLayoutParams();

        $query = [
            'topic' => $topic->getId(),
        ];

        $paging = app()->helpService()
            ->loadPostPaging($query, $page = 1, $limit = 10);


        $this->view->setScript($lp)
            ->assign([
                'topic'     => $topic,
                'paging'    => $paging,
                'lp'        => $lp,
                'query'     => $query,
                'pagingUrl' => 'ajax/platform/help/post/paging'
            ]);
    }

    /**
     *
     */
    public function actionViewPost()
    {
        $slug = $this->request->getParam('post');

        $post = app()->helpService()->findPost($slug);

        if (!$post) {
            $this->request->forward(null, 'index');

            return;
        }

        $lp = app()->layouts()->getContentLayoutParams();

        $topic = $post->getTopic();

        $this->view
            ->setScript($lp)
            ->assign([
                'lp'    => $lp,
                'item'  => $post,
                'topic' => $topic,
            ]);
    }

    public function actionViewPage()
    {
        $slug = $this->request->getParam('page');

        $page = app()->helpService()
            ->findPage($slug);

        if (!$page)
            return $this->request->forward(null, 'index');

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign(['item' => $page]);
    }

    /**
     * view post
     *
     */
    public function actionView()
    {
        list($categoryId, $topicId, $postId) = $this->request->getList('category', 'topic', 'post');


        if (empty($categoryId))
            return $this->request->forward(null, 'index');

        if (empty($topicId))
            return $this->request->forward(null, 'view-category');

        if (empty($postId))
            return $this->request->forward(null, 'view-topic');

        return $this->request->forward(null, 'view-post');
    }
}