<?php

namespace Blog\Controller\Admin;

use Blog\Form\Admin\FilterBlogPost;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Blog\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterBlogPost();

        \App::layout()
            ->setPageName('admin_simple')
            ->setPageFilter($filter)
            ->setPageTitle('blog.manage_blogs')
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_manage');


        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $query = $filter->getData();

        $paging = \App::blog()
            ->loadAdminPostPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'base/blog/paging/admin/browse-post',
            'endless'   => 1,
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'filter'    => $filter,
                'pagingUrl' => 'admin/blog/ajax/manage/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
            ]);
    }

}