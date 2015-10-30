<?php

namespace Attribute\Controller\Admin;

use Attribute\Form\Admin\CreateAttributeCatalog;
use Attribute\Form\Admin\EditAttributeCatalog;
use Attribute\Form\Admin\FilterAttributeCatalog;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class ManageController
 *
 * @package Attribute\Controller\Admin
 */
class ManageController extends AdminController
{

    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_attribute', 'admin_attribute_attribute');
    }

    /**
     * Browse all catalog
     */
    public function actionBrowse()
    {
        $page = 1;
        $filter = new FilterAttributeCatalog();
        $contentId = $this->request->getParam('content_id', 'user');

        $filter->isValid([
            'content_id' => $contentId,
        ]);

        $query = $filter->getData();

        $paging = \App::attribute()
            ->loadAdminCatalogPaging($query, $page);

        $lp = new BlockParams([
            'base_path'   => 'base/attribute/controller/admin/manage/browse-catalog',
            'item_path'   => 'base/attribute/paging/admin/browse-catalog',
//            'item_script' => 'render2',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'query'     => $query,
                'paging'    => $paging,
                'lp'        => $lp,
                'filter'    => $filter,
                'pagingUrl' => 'admin/attribute/ajax/manage/paging',
            ]);
    }

    /**
     * Create new catalog
     */
    public function actionCreate()
    {
        $form = new CreateAttributeCatalog();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $catalog = \App::attribute()
                ->addCatalog($data);

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff'      => 'attribute/manage/browse',
                'content_id' => $catalog->getContentId()]);
        }

        $lp = new BlockParams([
            'base_path' => 'base/core/form-edit',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }

    public function actionSetting()
    {
        $catalogId = $this->request->getParam('catalogId');

        $catalog = \App::attribute()
            ->findCatalogById($catalogId);

        if (!$catalog)
            throw new \InvalidArgumentException("Invalid Catalog");

        $listSection = $catalog->getListSection();

        $lp = new BlockParams([
            'base_path' => 'base/attribute/controller/admin/manage/setting',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'listSection' => $listSection,
                'catalog'     => $catalog,
                'catalogId'   => $catalogId]);
    }

    /**
     * Add section to this catalog
     */
    public function actionAddSection()
    {
        $catalogId = $this->request->getParam('catalogId');

        $catalog = \App::attribute()
            ->findCatalogById($catalogId);

        if (!$catalog)
            throw new \InvalidArgumentException("Invalid Catalog");

        $query = [
            'content_id' => $catalog->getContentId(),
            'excludes'   => $catalog->getListSectionId(),
        ];

        $paging = \App::attribute()
            ->loadAdminSectionPaging($query, 1, 1000);

        $lp = new BlockParams([
            'base_path' => 'base/attribute/controller/admin/manage/add-section',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'paging'    => $paging,
                'catalog'   => $catalog,
                'catalogId' => $catalogId]);
    }

    /**
     * Create new catalog
     */
    public function actionEdit()
    {
        $id = $this->request->getParam('catalogId');

        $entry = \App::attribute()
            ->findCatalogById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find catalog");

        $form = new EditAttributeCatalog();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff'      => 'attribute/manage/browse',
                'content_id' => $entry->getContentId()]);
        }

        $lp = new BlockParams([
            'base_path' => 'base/core/form-edit',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }

    /**
     *
     */
    public function actionDelete()
    {
        $id = $this->request->getParam('catalogId');

        $entry = \App::attribute()
            ->findCatalogById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find catalog");

        $form = new EditAttributeCatalog();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                    'stuff'      => 'attribute/manage/browse',
                    'content_id' => $entry->getContentId()
                ]);
        }

        $lp = new BlockParams([
            'base_path' => 'base/core/form-edit',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }
}