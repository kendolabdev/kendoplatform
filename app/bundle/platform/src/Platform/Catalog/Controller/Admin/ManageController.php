<?php

namespace Platform\Catalog\Controller\Admin;

use Platform\Catalog\Form\Admin\CreateAttributeCatalog;
use Platform\Catalog\Form\Admin\EditAttributeCatalog;
use Platform\Catalog\Form\Admin\FilterAttributeCatalog;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

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
        app()->layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_attribute', 'admin_attribute_attribute');
    }

    /**
     * Browse all catalog
     */
    public function actionBrowse()
    {
        $filter = new FilterAttributeCatalog();

        app()->layouts()
            ->setPageTitle('attribute.manage_catalogs')
            ->setPageFilter($filter)
            ->setPageButtons([
                [
                    'label' => 'attribute.add_new_catalogs',
                    'props' => [
                        'href'  => app()->routing()->getUrl('admin', ['stuff' => 'attribute/manage/create']),
                        'class' => 'btn btn-sm btn-danger'
                    ]]
            ]);

        $page = 1;
        $contentId = $this->request->getParam('content_id', 'user');

        $filter->isValid([
            'content_id' => $contentId,
        ]);

        $query = $filter->getData();

        $paging = app()->catalogService()
            ->loadAdminCatalogPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'platform/attribute/paging/admin/browse-catalog',
            //            'item_script' => 'render2',
        ]);

        $this->view->setScript($lp)
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

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $catalog = app()->catalogService()
                ->addCatalog($data);

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', [
                'stuff'      => 'attribute/manage/browse',
                'content_id' => $catalog->getContentId()]);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }

    public function actionSetting()
    {
        $catalogId = $this->request->getParam('catalogId');

        $catalog = app()->catalogService()
            ->findCatalogById($catalogId);

        if (!$catalog)
            throw new \InvalidArgumentException("Invalid Catalog");

        $listSection = $catalog->getListSection();

        $lp = new BlockParams([
            'base_path' => 'platform/attribute/controller/admin/manage/setting',
        ]);

        $this->view->setScript($lp)
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

        $catalog = app()->catalogService()
            ->findCatalogById($catalogId);

        if (!$catalog)
            throw new \InvalidArgumentException("Invalid Catalog");

        $query = [
            'content_id' => $catalog->getContentId(),
            'excludes'   => $catalog->getListSectionId(),
        ];

        $paging = app()->catalogService()
            ->loadAdminSectionPaging($query, 1, 1000);

        $lp = new BlockParams([
            'base_path' => 'platform/attribute/controller/admin/manage/add-section',
        ]);

        $this->view->setScript($lp)
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

        $entry = app()->catalogService()
            ->findCatalogById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find catalog");

        $form = new EditAttributeCatalog();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', [
                'stuff'      => 'attribute/manage/browse',
                'content_id' => $entry->getContentId()]);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit',
        ]);

        $this->view->setScript($lp)
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

        $entry = app()->catalogService()
            ->findCatalogById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find catalog");

        $form = new EditAttributeCatalog();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $entry->delete();

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', [
                'stuff'      => 'attribute/manage/browse',
                'content_id' => $entry->getContentId()
            ]);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-edit',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }
}