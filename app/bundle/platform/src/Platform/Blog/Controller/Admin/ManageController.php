<?php

namespace Platform\Blog\Controller\Admin;

use Platform\Blog\Form\Admin\FilterBlogPost;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Base\Blog\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterBlogPost();

        app()->layouts()
            ->setPageName('admin_simple')
            ->setPageFilter($filter)
            ->setPageTitle('blog.manage_blogs')
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_manage');


        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $query = $filter->getData();

        $paging = app()->blogService()
            ->loadAdminPostPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'platform/blog/paging/admin/browse-post',
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