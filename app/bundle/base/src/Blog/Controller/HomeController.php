<?php

namespace Blog\Controller;

use Blog\Form\AddPost;
use Blog\Form\DeletePost;
use Blog\Model\BlogPost;
use Blog\Model\Post;
use Blog\Service\BlogService;
use Picaso\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Blog\Controller
 */
class HomeController extends DefaultController
{

    /**
     * Browse blog in various mode
     */
    public function actionBrowseBlog()
    {
        \App::acl()
            ->required('blog__view');

        $page = $this->request->getParam('page', 1);

        $paging = \App::blog()->loadPostPaging([], $page);

        $paging->setRouting('blogs', ['page' => $page]);

        $query = [];

        $lp = \App::layout()->getContentLayoutParams();

        \App::layout()
            ->setupSecondaryNavigation('blog_main', null, 'blog_browse');

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/blog/blog/paging',
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
        \App::acl()
            ->required('blog__view');

        \App::assets()
            ->setTitle(\App::text('blog.my_blogs'));

        $page = $this->request->getParam('page', 1);

        \App::layout()
            ->setupSecondaryNavigation('blog_main', null, 'blog_my');

        $poster = \App::auth()->getViewer();

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = \App::blog()->loadPostPaging($query, $page);

        $lp = \App::layout()->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'pagingUrl' => 'ajax/blog/blog/paging',
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
        \App::acl()->required('blog__create');

        \App::layout()
            ->setupSecondaryNavigation('blog_main', null, 'blog_import');

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script());
    }

    /**
     *
     */
    public function actionCreateBlog()
    {

        \App::acl()->required('blog__create');

        \App::assets()
            ->setTitle(\App::text('blog.add_blog_post'));

        \App::layout()
            ->setupSecondaryNavigation('blog_main', null, 'blog_create');

        $poster = \App::auth()->getViewer();

        $form = new AddPost();

        if (\App::setting('blog', 'use_captcha')) {
            $form->addElement([
                'plugin' => 'captcha',
            ]);
        }

        $lp = \App::layout()->getContentLayoutParams();


        $this->view
            ->setScript($lp->script())
            ->assign(['form' => $form]);


        /**
         * Is Post method
         */
        if ($this->request->isPost() && $form->isValid($_POST)) {

            $data = $form->getData();

            $data = array_merge($data,
                \App::relation()->getRelationFromDataForSave($data, ['blog__view', 'activity__comment']));

            $post = \App::blog()->addPost($poster, $poster, $data);

            \App::feed()->addItemFeed('blog_post_add', $post);

            \App::routing()->redirect('blog_my');
        }
    }

    /**
     * edit blog
     */
    public function actionEditBlog()
    {
        \App::acl()->required('blog__edit');

        $id = $this->request->getString('id');

        $post = \App::blog()->findPost($id);

        if (!$post instanceof BlogPost) {
            throw new \InvalidArgumentException("Could not find blog post");
        }

        \App::layout()
            ->setupSecondaryNavigation('blog_main', null, 'blog_browse');

        $form = \App::html()->factory('\Blog\Form\EditPost');

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

            $data = array_merge($data, \App::relation()->getRelationFromDataForSave($data, ['blog__view', 'comment']));

            $post->setFromArray($data);

            $post->save();

            \App::routing()->redirect('blog_my');
        }

        $this->view->assign(['form' => $form]);

        $this->view->setScript('base/blog/controller/home/edit-blog');

    }

    /**
     * edit blog
     */
    public function actionDeleteBlog()
    {
        $blogService = \App::service('blog');

        if ($blogService instanceof BlogService) ;

        $id = $this->request->getParam('id');

        $post = $blogService->findPost($id);

        if (!$post instanceof Post) {
            throw new \InvalidArgumentException("Could not find blog post");
        }

        $form = new DeletePost();

        if ($this->request->isGet()) {
            $form->setData($post);
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $post->delete();
            \App::routing()->redirect('blog_my');
        }

        $this->view->assign(['form' => $form]);

        $this->view->setScript('base/blog/controller/home/delete-blog');

    }

    public function actionViewBlog()
    {

        \App::acl()->required('blog__view');


        $id = $this->request->getString('id');

        $post = \App::blog()->findPost($id);

        if (!$post instanceof Post)
            ;

        \App::assets()
            ->setTitle($post->getTitle())
            ->setDescription($post->getDescription());

        $lp = \App::layout()->getContentLayoutParams();

        \App::registry()
            ->set('about', $post);

        $this->view->setScript($lp->script())
            ->assign([
                'post' => $post,
            ]);
    }
}