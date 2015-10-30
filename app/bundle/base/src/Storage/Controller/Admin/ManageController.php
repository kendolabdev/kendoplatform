<?php

namespace Storage\Controller\Admin;


use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;
use Storage\Form\Admin\SelectStorage;


/**
 * Class ManageController
 *
 * @package Storage\Controller\Admin
 */
class ManageController extends AdminController
{
    /**
     *
     */
    public function actionBrowse()
    {
        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'browse');

        $limit = 100;
        $page = 1;
        $query = [];

        $paging = \App::storage()
            ->loadAdminPagingStorage($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/storage/controller/admin/manage/browse-storage',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'paging'    => $paging,
                'pagingUrl' => 'admin/storage/ajax/manage/paging',
                'query'     => $query,
                'lp'        => $lp,
            ]);
    }

    /**
     *
     */
    public function actionTransfer()
    {
        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'transfer');

        $this->view->setScript('/base/core/controller/admin/storage/transfer-storage');
    }

    /**
     *
     */
    public function actionCreate()
    {
        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'add');


        $form = new SelectStorage([]);

        $this->view->assign([
            'form' => $form,
        ]);

        $this->view->setScript('base/form-edit');
    }

    /**
     *
     */
    public function actionCreateComplete()
    {
        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'browse');

        $type = $this->request->getString('adapter', 'local');

        $adapter = \App::storage()
            ->findAdapterByType($type);

        $form = \App::html()->factory($adapter->getAdminForm());

        $this->view->assign([
            'form' => $form,
        ]);

        $this->view->setScript('/base/form-edit');

    }

    /**
     *
     */
    public function actionEdit()
    {
        \App::layout()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'browse');

        $id = $this->request->getInt('id', 1);

        $item = \App::storage()->findStorageById($id);

        $adapter = \App::storage()
            ->findAdapterByType($item->getAdapter());

        $form = \App::html()->factory($adapter->getAdminForm());

        $this->view->assign([
            'form' => $form,
        ]);

        $this->view->setScript('base/form-edit');
    }
}