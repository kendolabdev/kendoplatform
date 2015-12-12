<?php

namespace Platform\Page\Controller\Admin;

use Platform\Page\Form\Admin\FilterPage;
use Platform\Page\Form\Admin\PageSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Page\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    public function actionBrowse()
    {
        $filter = new FilterPage();

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setPageFilter($filter)
            ->setPageTitle('page.manage_pages')
            ->setupSecondaryNavigation('admin', 'page_extension', 'page_manage');

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = \App::pageService()
            ->loadPagePaging($query, $page, $limit);

        $lp = new BlockParams([
            'base_path'      => 'base/page/controller/admin/manage/browse-page',
            'item_path'      => 'base/page/paging/admin/browse-page',
            'media_position' => 'media-aside-left',
            'grid_md'        => 'col-md-12',
            'grid_sm'        => 'col-sm-12',
            'endless'        => 1,
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'pagingUrl' => 'ajax/page/page/paging',
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'filter'    => $filter,
            ]);
    }

    /**
     *
     */
    public function actionBrowseCategory()
    {

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'page_extension', 'page_category');


    }

    /**
     *
     */
    public function actionSettings()
    {

        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'page_extension', 'page_settings');

        $this->request->setParam('name', 'page.admin.page-setting');

        $form = new PageSetting([]);


        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
        }

        if ($this->request->isGet()) {
            $form->load();
        }

        $lp = new BlockParams([
            'base_path'=> 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);

    }

    /**
     *
     */
    public function actionPermission()
    {
        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'page_extension', 'page_permission');

        $this->request->setParam('groupId', 'page');
        $this->request->setParam('forward', true);

        $this->forward('\Core\Controller\Admin\PermissionController', 'edit');
    }
}