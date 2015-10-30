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
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'blog_extension', 'blog_manage');

        /**
         *
         */
        $filter = new FilterBlogPost();

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $query = $filter->getData();

        $paging = \App::blog()
            ->loadAdminPostPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'base/blog/controller/admin/manage/browse-post',
            'item_path' => 'base/blog/paging/admin/browse-post',
            'endless'   => 1,
        ]);

        $this->view
            ->setScript($lp->script())
            ->assign([
                'filter'    => $filter,
                'pagingUrl' => 'admin/blog/ajax/manage/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
            ]);
    }

}