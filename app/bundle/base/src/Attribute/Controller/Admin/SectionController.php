<?php

namespace Attribute\Controller\Admin;

use Attribute\Form\Admin\CreateAttributeSection;
use Attribute\Form\Admin\EditAttributeSection;
use Attribute\Form\Admin\FilterAttributeSection;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

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
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_attribute', 'admin_attribute_section');
    }

    /**
     * Browse all catalog
     */
    public function actionBrowse()
    {
        $page = 1;
        $filter = new FilterAttributeSection();
        $contentId = $this->request->getParam('content_id', 'user');

        $filter->isValid([
            'q'          => $this->request->getParam('q'),
            'content_id' => $contentId,
        ]);

        $query = $filter->getData();

        $paging = \App::attribute()
            ->loadAdminSectionPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'base/attribute/controller/admin/section/browse-section',
            'item_path' => 'base/attribute/paging/admin/browse-section'
        ]);

        $this->view->setScript($lp->script())
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

        $section = \App::attribute()
            ->findSectionById($sectionId);

        $listField = $section->getListField();

        $lp = new BlockParams([
            'base_path' => 'base/attribute/controller/admin/section/setting',
        ]);

        $this->view->setScript($lp->script())
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

        $section = \App::attribute()
            ->findSectionById($sectionId);

        $excludes = $section->getListFieldId();

        $query = [
            'excludes'   => $excludes,
            'content_id' => $section->getContentId(),
        ];

        $paging = \App::attribute()
            ->loadAdminFieldPaging($query, 1, 1000);

        $lp = new BlockParams([
            'base_path' => 'base/attribute/controller/admin/section/add-field',
        ]);

        $this->view->setScript($lp->script())
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

        $attribute = \App::attribute();
        $catalog = null;
        $catalogId = $this->request->getParam('catalogId');

        if ($catalogId)
            $catalog = \App::attribute()
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

            \App::cache()
                ->flush();

            $params = [
                'stuff'      => 'attribute/manage/setting',
                'content_id' => $section->getContentId(),
            ];

            if ($catalog)
                $params['catalogId'] = $catalog->getId();

            \App::routing()->redirect('admin', $params);
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
     * Create new catalog
     */
    public function actionEdit()
    {
        $id = $this->request->getParam('sectionId');

        $entry = \App::attribute()
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

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff'   => 'attribute/section/browse',
                'content' => $data['content_type']]);
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
        $id = $this->request->getParam('sectionId');

        $entry = \App::attribute()
            ->findSectionById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find section");

        $form = new EditAttributeSection();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff' => 'attribute/section/browse']);
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