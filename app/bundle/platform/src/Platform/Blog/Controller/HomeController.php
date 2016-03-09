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
        app()->aclService()
            ->required('blog__view');

        $filter = new FilterBlogPost();

        $page = $this->request->getParam('page', 1);

        $paging = app()->blogService()->loadPostPaging([], $page);

        $paging->setRouting('blogs', ['page' => $page]);

        $query = [];

        $lp = app()->layouts()->getContentLayoutParams();

        app()->layouts()
            ->setupSecondaryNavigation('blog_main', null, 'blog_browse')
            ->setPageTitle('blog.blogs')
            ->setPageFilter($filter)
            ->setBreadcrumbs([
                [
                    'url'   => app()->routing()->getUrl('blogs'),
                    'label' => 'blog.blogs',
                ],
            ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/blog/post/paging',
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
        app()->aclService()
            ->required('blog__view');

        $page = $this->request->getParam('page', 1);

        app()->layouts()
            ->setupSecondaryNavigation('blog_main', null, 'blog_my')
            ->setPageTitle('blog.my_blogs')
            ->setBreadcrumbs([
                [
                    'label' => 'blog.blogs',
                    'url'   => app()->routing()->getUrl('blogs')],
                [
                    'label' => 'blog.my_blogs',
                    'url'   => app()->routing()->getUrl('blog_my')]
            ]);

        $poster = app()->auth()->getViewer();

        $query = ['posterId' => $poster->getId(), 'posterType' => $poster->getType()];

        $paging = app()->blogService()->loadPostPaging($query, $page);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/platform/blog/post/paging',
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
        app()->aclService()->required('blog__create');

        app()->layouts()
            ->setupSecondaryNavigation('blog_main', null, 'blog_import')
            ->setPageTitle('blog.import_blogs')
            ->setBreadcrumbs([
                [
                    'url'   => app()->routing()->getUrl('blogs'),
                    'label' => 'blog.blogs'],
                [
                    'url'   => app()->routing()->getUrl('blog_my'),
                    'label' => 'blog.import_blogs']
            ]);

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view->setScript($lp);
    }

    /**
     *
     */
    public function actionCreateBlog()
    {

        app()->aclService()->required('blog__create');

        app()->layouts()
            ->setupSecondaryNavigation('blog_main', null, 'blog_create')
            ->setPageTitle('blog.create_blog')
            ->setBreadcrumbs([
                [
                    'url'   => app()->routing()->getUrl('blogs'),
                    'label' => 'blog.blogs'],
                [
                    'url'   => app()->routing()->getUrl('blog_my'),
                    'label' => 'blog.create_blogs']
            ]);

        $poster = app()->auth()->getViewer();

        $form = new AddPost();

        if (app()->setting('blog', 'use_captcha')) {
            $form->addElement([
                'plugin' => 'captcha',
            ]);
        }

        $lp = app()->layouts()->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign(['form' => $form]);


        /**
         * Is Post method
         */
        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $data = $form->getData();

            $data = array_merge($data,
                app()->relation()->getRelationFromDataForSave($data, ['blog__view', 'activity__comment']));

            $post = app()->blogService()->addPost($poster, $poster, $data);

            app()->feedService()->addItemFeed('blog_post_add', $post);

            app()->routing()->redirect('blog_my');
        }
    }

    /**
     * edit blog
     */
    public function actionEditBlog()
    {
        app()->aclService()->required('blog__edit');

        $id = $this->request->getString('id');

        $post = app()->blogService()->findPost($id);

        if (!$post instanceof BlogPost) {
            throw new \InvalidArgumentException("Could not find blog post");
        }

        app()->layouts()
            ->setupSecondaryNavigation('blog_main', null, 'blog_browse')
            ->setPageTitle('blog.edit_blog');

        $form = app()->html()->factory('\Blog\Form\EditPost');

        if ($this->request->isMethod('get')) {

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

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $data = $form->getData($_POST);

            $data = array_merge($data, app()->relation()->getRelationFromDataForSave($data, ['blog__view', 'comment']));

            $post->setFromArray($data);

            $post->save();

            app()->routing()->redirect('blog_my');
        }

        $this->view->assign(['form' => $form]);

        $this->view->setScript('platform/blog/controller/home/edit-blog');

    }

    /**
     * edit blog
     */
    public function actionDeleteBlog()
    {
        $blogService = app()->blogService();

        if ($blogService instanceof BlogService) ;

        $id = $this->request->getParam('id');

        $post = $blogService->findPost($id);

        if (!$post instanceof BlogPost) {
            throw new \InvalidArgumentException("Could not find blog post");
        }

        $form = new DeletePost();

        if ($this->request->isMethod('get')) {
            $form->setData($post);
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $post->delete();
            app()->routing()->redirect('blog_my');
        }

        $this->view->assign(['form' => $form]);

        $this->view->setScript('platform/blog/controller/home/delete-blog');

    }

    public function actionViewBlog()
    {

        app()->aclService()->required('blog__view');

        $id = $this->request->getString('id');

        $post = app()->blogService()->findPost($id);

        if (!$post instanceof BlogPost)
            ;

        app()->assetService()
            ->setTitle($post->getTitle())
            ->setDescription($post->getDescription());

        app()->layouts()
            ->setPageTitle($post->getTitle())
            ->setBreadcrumbs([
                [
                    'url'   => app()->routing()->getUrl('blogs'),
                    'label' => app()->text('blog.blogs'),],
                [
                    'url'   => app()->routing()->getUrl('blog_my'),
                    'label' => app()->text('blog.my_blogs'),]
            ]);

        $lp = app()->layouts()->getContentLayoutParams();

        app()->registryService()
            ->set('about', $post);

        $this->view->setScript($lp)
            ->assign([
                'post' => $post,
            ]);
    }
}