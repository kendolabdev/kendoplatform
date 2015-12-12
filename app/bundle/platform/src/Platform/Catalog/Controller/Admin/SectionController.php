<?php

namespace Platform\Catalog\Controller\Admin;

use Platform\Catalog\Form\Admin\CreateAttributeSection;
use Platform\Catalog\Form\Admin\EditAttributeSection;
use Platform\Catalog\Form\Admin\FilterAttributeSection;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

/**
 * Class SectionController
 *
 * @package Attribute\Controller\Admin
 */
class SectionController extends AdminController
{
    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layoutService()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_attribute', 'admin_attribute_section');
    }

    /**
     * Browse all catalog
     */
    public function actionBrowse()
    {
        $filter = new FilterAttributeSection();

        \App::layoutService()
            ->setPageTitle('attribute.manage_sections')
            ->setPageFilter($filter)
            ->setPageButtons([
                [
                    'label' => 'attribute.add_new_section',
                    'props' => [
                        'href'   => \App::routingService()->getUrl('admin', ['stuff' => 'attribute/section/create']),
                        'class' => 'btn btn-sm btn-danger'
                    ]]
            ]);

        $page = 1;

        $contentId = $this->request->getParam('content_id', 'user');

        $filter->isValid([
            'q'          => $this->request->getParam('q'),
            'content_id' => $contentId,
        ]);

        $query = $filter->getData();

        $paging = \App::catalogService()
            ->loadAdminSectionPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'platform/attribute/paging/admin/browse-section'
        ]);

        $this->view->setScript($lp)
            ->assign([
                'query'     => $query,
                'paging'    => $paging,
                'lp'        => $lp,
                'filter'    => $filter,
                'pagingUrl' => 'admin/attribute/ajax/section/paging',
            ]);
    }

    /**
     * Control section & fields in sections
     */
    public function actionSetting()
    {
        $sectionId = $this->request->getParam('sectionId');

        $section = \App::catalogService()
            ->findSectionById($sectionId);

        $listField = $section->getListField();

        $lp = new BlockParams([
            'base_path' => 'platform/attribute/controller/admin/section/setting',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'section'   => $section,
                'sectionId' => $sectionId,
                'listField' => $listField,
            ]);
    }

    /**
     * Add new to current section
     */
    public function actionAddField()
    {
        $sectionId = $this->request->getParam('sectionId');

        $section = \App::catalogService()
            ->findSectionById($sectionId);

        $excludes = $section->getListFieldId();

        $query = [
            'excludes'   => $excludes,
            'content_id' => $section->getContentId(),
        ];

        $paging = \App::catalogService()
            ->loadAdminFieldPaging($query, 1, 1000);

        $lp = new BlockParams([
            'base_path' => 'platform/attribute/controller/admin/section/add-field',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'lp'        => $lp,
                'paging'    => $paging,
                'query'     => $query,
                'section'   => $section,
                'sectionId' => $sectionId,
            ]);
    }

    /**
     * Create new catalog
     */
    public function actionCreate()
    {
        $form = new CreateAttributeSection();

        $attribute = \App::catalogService();
        $catalog = null;
        $catalogId = $this->request->getParam('catalogId');

        if ($catalogId)
            $catalog = \App::catalogService()
                ->findCatalogById($catalogId);

        if ($catalog)
            $form->removeElement('content_id');

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            if ($catalog)
                $data['content_id'] = $catalog->getContentId();

            $section = $attribute->addSection($data);

            if ($catalog)
                $attribute->addSectionMap($catalog->getId(), $section->getId());

            \App::cacheService()
                ->flush();

            $params = [
                'stuff'      => 'attribute/manage/setting',
                'content_id' => $section->getContentId(),
            ];

            if ($catalog)
                $params['catalogId'] = $catalog->getId();

            \App::routingService()->redirect('admin', $params);
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
     * Create new catalog
     */
    public function actionEdit()
    {
        $id = $this->request->getParam('sectionId');

        $entry = \App::catalogService()
            ->findSectionById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find section");

        $form = new EditAttributeSection();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            \App::cacheService()
                ->flush();

            \App::routingService()->redirect('admin', [
                'stuff'   => 'attribute/section/browse',
                'content' => $data['content_type']]);
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
        $id = $this->request->getParam('sectionId');

        $entry = \App::catalogService()
            ->findSectionById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find section");

        $form = new EditAttributeSection();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cacheService()
                ->flush();

            \App::routingService()->redirect('admin', [
                'stuff' => 'attribute/section/browse']);
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