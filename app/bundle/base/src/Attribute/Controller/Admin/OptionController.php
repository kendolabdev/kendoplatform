<?php

namespace Attribute\Controller\Admin;

use Attribute\Form\Admin\CreateAttributeOption;
use Attribute\Form\Admin\DeleteAttributeField;
use Attribute\Form\Admin\DeleteAttributeOption;
use Attribute\Form\Admin\EditAttributeOption;
use Picaso\Controller\AdminController;
use Picaso\Layout\BlockParams;

/**
 * Class OptionController
 *
 * @package Attribute\Controller\Admin
 */
class OptionController extends AdminController
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
            ->setPageTitle('attribute.manage_options')
            ->setPageButtons([
                [
                    'label' => 'attribute.add_new_option',
                    'props' => [
                        'href'   => \App::routing()->getUrl('admin', ['stuff' => 'attribute/option/create']),
                        'class' => 'btn btn-sm btn-danger'
                    ]]
            ]);

        $page = 1;
        $fieldId = $this->request->getParam('fieldId');
        $query = ['field' => $fieldId];

        $paging = \App::attribute()
            ->loadAdminOptionPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'base/attribute/controller/admin/option/browse-option',
            'item_path' => 'base/attribute/paging/admin/browse-option'
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'query'     => $query,
                'paging'    => $paging,
                'lp'        => $lp,
                'fieldId'   => $fieldId,
                'pagingUrl' => 'admin/attribute/ajax/option/paging',
            ]);
    }

    /**
     * Create new catalog
     */
    public function actionCreate()
    {
        $fieldId = $this->request->getParam('fieldId');

        $form = new CreateAttributeOption();

        if ($this->request->isGet()) {
            $form->setData(['field_id' => $fieldId]);
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $data = $form->getData();

            \App::attribute()
                ->addFieldOption($data);

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff'   => 'attribute/option/browse',
                'fieldId' => $data['field_id']]);
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
        $id = $this->request->getParam('id');

        $entry = \App::attribute()
            ->findOptionById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find field");

        $form = new EditAttributeOption();

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
                'stuff'   => 'attribute/option/browse',
                'fieldId' => $data['field_id']]);
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
        $id = $this->request->getParam('id');

        $entry = \App::attribute()
            ->findOptionById($id);
        
        if (!$entry)
            throw new \InvalidArgumentException("Could not find option");

        $form = new DeleteAttributeOption();

        if ($this->request->isGet()) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {

            $entry->delete();

            \App::cache()
                ->flush();

            \App::routing()->redirect('admin', [
                'stuff'   => 'attribute/option/browse',
                'fieldId' => $entry->getFieldId(),
            ]);
        }

        $lp = new BlockParams([
            'base_path' => 'base/core/form-delete',
        ]);

        $this->view->setScript($lp->script())
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }
}