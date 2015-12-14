<?php

namespace Platform\Blog\Controller;

use Platform\Blog\Form\AddPost;
use Platform\Blog\Form\DeletePost;
use Platform\Blog\Form\FilterBlogPost;
use Platform\Blog\Model\BlogPost;
use Platform\Blog\Service\BlogService;
use Kendo\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Base\Blog\Controller
 */
class HomeController extends DefaultController
{

    /**
     * Browse blog in various mode
     */
    public function actionBrowseBlog()
    {
        \App::aclService()
            ->required('blog__view');

        $filter = new FilterBlogPost();

        $page = $this->request->getParam('page', 1);

        $paging = \App::blogService()->loadPostPaging([], $page);

        $paging->setRouting('blogs', ['page' => $page]);

        $query = [];

        $lp = \App::layoutService()->getContentLayoutParams();

        \App::layoutService()
            ->setupSecondaryNavigation('blog_main', null, 'blog_browse')
            ->setPageTitle('blog.blogs')
            ->setPageFilter($filter)
            ->setBreadcrumbs([
                [
                    'url'   => \App::routingService()->getUrl('blogs'),
                    'label' => 'blog.blogs',
                ],
            ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/blog/post/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionMyBlog()
    {
        \App::aclService()
            ->required('blog__view');

        $page = $this->request->getParam('page', 1);

        \App::layoutService()
            ->setupSecondaryNavigation('blog_main', null, 'blog_my')
            ->setPageTitle('blog.my_blogs')
            ->setBreadcrumbs([
                [
                    'label' => 'blog.blogs',
                    'url'   => \App::routingService()->getUrl('blogs')],
                [
                    'label' => 'blog.my_blogs',
                    'url'   => \App::routingService()->getUrl('blog_my')]
            ]);

        $poster = \App::authService()->getViewer();

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = \App::blogService()->loadPostPaging($query, $page);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/blog/post/paging',
                'paging'    => $paging,
                'pager'     => $paging->getPager(),
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionImportBlog()
    {
        \App::aclService()->required('blog__create');

        \App::layoutService()
            ->setupSecondaryNavigation('blog_main', null, 'blog_import')
            ->setPageTitle('blog.import_blogs')
            ->setBreadcrumbs([
                [
                    'url'   => \App::routingService()->getUrl('blogs'),
                    'label' => 'blog.blogs'],
                [
                    'url'   => \App::routingService()->getUrl('blog_my'),
                    'label' => 'blog.import_blogs']
            ]);

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view->setScript($lp);
    }

    /**
     *
     */
    public function actionCreateBlog()
    {

        \App::aclService()->required('blog__create');

        \App::layoutService()
            ->setupSecondaryNavigation('blog_main', null, 'blog_create')
            ->setPageTitle('blog.create_blog')
            ->setBreadcrumbs([
                [
                    'url'   => \App::routingService()->getUrl('blogs'),
                    'label' => 'blog.blogs'],
                [
                    'url'   => \App::routingService()->getUrl('blog_my'),
                    'label' => 'blog.create_blogs']
            ]);

        $poster = \App::authService()->getViewer();

        $form = new AddPost();

        if (\App::setting('blog', 'use_captcha')) {
            $form->addElement([
                'plugin' => 'captcha',
            ]);
        }

        $lp = \App::layoutService()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign(['form' => $form]);


        /**
         * Is Post method
         */
        if ($this->request->isPost() && $form->isValid($_POST)) {

            $data = $form->getData();

            $data = array_merge($data,
                \App::relationService()->getRelationFromDataForSave($data, ['blog__view', 'activity__comment']));

            $post = \App::blogService()->addPost($poster, $poster, $data);

            \App::feedService()->addItemFeed('blog_post_add', $post);

            \App::routingService()->redirect('blog_my');
        }
    }

    /**
     * edit blog
     */
    public function actionEditBlog()
    {
        \App::aclService()->required('blog__edit');

        $id = $this->request->getString('id');

        $post = \App::blogService()->findPost($id);

        if (!$post instanceof BlogPost) {
            throw new \InvalidArgumentException("Could not find blog post");
        }

        \App::layoutService()
            ->setupSecondaryNavigation('blog_main', null, 'blog_browse')
            ->setPageTitle('blog.edit_blog');

        $form = \App::htmlService()->factory('\Blog\Form\EditPost');

        if ($this->request->isGet()) {

            $form->setData($post);

            $form->getElement('blog__view')
                ->setForItem($post);

            $form->getElement('activity__comment')
                ->setForItem($post);
        }

        // could not unpublish post
        if ($post->isPublished()) {
            $form->removeElement('is_published');
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {

            $data = $form->getData($_POST);

            $data = array_merge($data, \App::relationService()->getRelationFromDataForSave($data, ['blog__view', 'comment']));

            $post->setFromArray($data);

            $post->save();

            \App::routingService()->redirect('blog_my');
        }

        $this->view->assign(['form' => $form]);

        $this->view->setScript('platform/blog/controller/home/edit-blog');

    }

    /**
     * edit blog
     */
    public function actionDeleteBlog()
    {
        $blogService = \App::blogService();

        if ($blogService instanceof BlogService) ;

        $id = $this->request->getParam('id');

        $post = $blogService->findPost($id);

        if (!$post instanceof BlogPost) {
            throw new \InvalidArgumentException("Could not find blog post");
        }

        $form = new DeletePost();

        if ($this->request->isGet()) {
            $form->setData($post);
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $post->delete();
            \App::routingService()->redirect('blog_my');
        }

        $this->view->assign(['form' => $form]);

        $this->view->setScript('platform/blog/controller/home/delete-blog');

    }

    public function actionViewBlog()
    {

        \App::aclService()->required('blog__view');

        $id = $this->request->getString('id');

        $post = \App::blogService()->findPost($id);

        if (!$post instanceof BlogPost)
            ;

        \App::assetService()
            ->setTitle($post->getTitle())
            ->setDescription($post->getDescription());

        \App::layoutService()
            ->setPageTitle($post->getTitle())
            ->setBreadcrumbs([
                [
                    'url'   => \App::routingService()->getUrl('blogs'),
                    'label' => \App::text('blog.blogs'),],
                [
                    'url'   => \App::routingService()->getUrl('blog_my'),
                    'label' => \App::text('blog.my_blogs'),]
            ]);

        $lp = \App::layoutService()->getContentLayoutParams();

        \App::registryService()
            ->set('about', $post);

        $this->view->setScript($lp)
            ->assign([
                'post' => $post,
            ]);
    }
}