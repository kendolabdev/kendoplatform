<?php

namespace Page\Controller\Admin;

use Page\Form\Admin\FilterPage;
use Page\Form\Admin\PageSetting;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

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
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'page_extension', 'page_manage');

        $filter = new FilterPage();

        $filter->isValid($this->request->getParams());

        $page = $this->request->getParam('page', 1);
        $limit = 24;
        $query = $filter->getData();

        $paging = \App::page()
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
            ->setScript($lp->script())
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

        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'page_extension', 'page_category');


    }

    /**
     *
     */
    public function actionSettings()
    {

        \App::layout()
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

        $this->view->setScript('base/form-edit')
            ->assign([
                'form' => $form,
            ]);

    }

    /**
     *
     */
    public function actionPermission()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'page_extension', 'page_permission');

        $this->request->setParam('groupId', 'page');
        $this->request->setParam('forward', true);

        $this->forward('\Core\Controller\Admin\PermissionController', 'edit');
    }
}