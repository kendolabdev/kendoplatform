<?php

namespace Attribute\Controller\Admin;

use Attribute\Form\Admin\CreateAttributeField;
use Attribute\Form\Admin\DeleteAttributeField;
use Attribute\Form\Admin\EditAttributeField;
use Attribute\Form\Admin\FilterAttributeField;
use Attribute\Form\PluginBaseSetting;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class FieldController
 *
 * @package Attribute\Controller\Admin
 */
class FieldController extends AdminController
{
    /**
     *
     */
    protected function onBeforeRender()
    {
        \App::layout()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_attribute', 'admin_attribute_field');
    }

    /**
     * Browse all catalog
     */
    public function actionBrowse()
    {
        \App::layout()
            ->setPageTitle('attribute.manage_fields')
            ->setPageButtons([
                [
                    'label' => 'attribute.add_new_field',
                    'props' => [
                        'href'   => \App::routing()->getUrl('admin', ['stuff' => 'attribute/field/create']),
                        'class' => 'btn btn-sm btn-danger'
                    ]]
            ]);

        $page = 1;
        $filter = new FilterAttributeField();

        $filter->isValid([
            'q' => $this->request->getParam('q'),
        ]);

        $query = $filter->getData();

        $paging = \App::attribute()
            ->loadAdminFieldPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'base/attribute/paging/admin/browse-field'
        ]);

        $this->view->setScript($lp)
            ->assign([
                'query'     => $query,
                'paging'    => $paging,
                'lp'        => $lp,
                'filter'    => $filter,
                'pagingUrl' => 'admin/attribute/ajax/field/paging',
            ]);
    }

    /**
     * Create new catalog
     */
    public function actionCreate()
    {
        $form = new CreateAttributeField();

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            \App::attribute()
                ->addField($data);

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff'   => 'attribute/field/browse',
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
     * Create new catalog
     */
    public function actionSetting()
    {
        $id = $this->request->getParam('fieldId');

        $entry = \App::attribute()
            ->findFieldById($id);

        $plugin = $entry->getPlugin();

        $formClass = $plugin->getPluginSetting();


        $form = new $formClass([
            'field' => $entry,
        ]);

        if (!$form instanceof PluginBaseSetting) ;

        $form->setTitle('Field Setting: ' . $entry->getTitle());
        $form->setNote('Edit setting for <b>' . $entry->getCode() . '</b>');

        if ($this->request->isGet()) {
            $form->load();
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {

            $form->save();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff'      => 'attribute/field/browse',
                'content_id' => $entry->getContentId(),
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

    /**
     * Create new catalog
     */
    public function actionEdit()
    {
        $id = $this->request->getParam('fieldId');

        $entry = \App::attribute()
            ->findFieldById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find field");

        $form = new EditAttributeField();

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
                'stuff'      => 'attribute/field/browse',
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
        $id = $this->request->getParam('fieldId');

        $entry = \App::attribute()
            ->findFieldById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find field");

        $form = new DeleteAttributeField();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff'      => 'attribute/field/browse',
                'content_id' => $entry->getContentId()]);
        }

        $lp = new BlockParams([
            'base_path' => 'layout/partial/form-delete',
        ]);

        $this->view->setScript($lp)
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }

    /**
     * Browse field option
     */
    public function actionBrowseOption()
    {
        $page = 1;
        $fieldId = $this->request->getParam('fieldId');

        $query = ['field' => $fieldId];

        $paging = \App::attribute()
            ->loadAdminOptionPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'base/attribute/controller/admin/field/browse-option',
            'item_path' => 'base/attribute/paging/admin/browse-option'
        ]);

        $this->view->setScript($lp)
            ->assign([
                'query'     => $query,
                'paging'    => $paging,
                'lp'        => $lp,
                'fieldId'   => $fieldId,
                'pagingUrl' => 'admin/attribute/ajax/option/paging',
            ]);
    }
}