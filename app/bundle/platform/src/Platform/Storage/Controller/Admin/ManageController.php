<?php

namespace Platform\Storage\Controller\Admin;


use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;
use Platform\Storage\Form\Admin\SelectStorage;


/**
 * Class ManageController
 *
 * @package Platform\Storage\Controller\Admin
 */
class ManageController extends AdminController
{
    /**
     *
     */
    public function actionBrowse()
    {
        \App::layoutService()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'browse');

        $limit = 100;
        $page = 1;
        $query = [];

        $paging = \App::storageService()
            ->loadAdminPagingStorage($query, $page, $limit);

        $lp = new BlockParams([
            'base_path' => 'base/storage/controller/admin/manage/browse-storage',
        ]);

        $this->view->setScript($lp)
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
        \App::layoutService()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'transfer');

        $this->view->setScript('/base/core/controller/admin/storage/transfer-storage');
    }

    /**
     *
     */
    public function actionCreate()
    {
        \App::layoutService()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'add');


        $form = new SelectStorage([]);

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
    public function actionCreateComplete()
    {
        \App::layoutService()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'browse');

        $type = $this->request->getString('adapter', 'local');

        $adapter = \App::storageService()
            ->findAdapterByType($type);

        $form = \App::htmlService()->factory($adapter->getAdminForm());

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
    public function actionEdit()
    {
        \App::layoutService()->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_storage', 'browse');

        $id = $this->request->getInt('id', 1);

        $item = \App::storageService()->findStorageById($id);

        $adapter = \App::storageService()
            ->findAdapterByType($item->getAdapter());

        $form = \App::htmlService()->factory($adapter->getAdminForm());

        $lp = new BlockParams([
            'base_path'=> 'layout/partial/form-edit'
        ]);

        $this->view
            ->setScript($lp)
            ->assign([
                'form' => $form,
            ]);
    }
}