<?php

namespace Platform\Catalog\Controller\Admin;

use Platform\Catalog\Form\Admin\CreateAttributeOption;
use Platform\Catalog\Form\Admin\DeleteAttributeOption;
use Platform\Catalog\Form\Admin\EditAttributeOption;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

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
        app()->layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_attribute', 'admin_attribute_field');
    }

    /**
     * Browse all catalog
     */
    public function actionBrowse()
    {

        app()->layouts()
            ->setPageTitle('attribute.manage_options')
            ->setPageButtons([
                [
                    'label' => 'attribute.add_new_option',
                    'props' => [
                        'href'  => app()->routing()->getUrl('admin', ['any' => 'attribute/option/create']),
                        'class' => 'btn btn-sm btn-danger'
                    ]]
            ]);

        $page = 1;
        $fieldId = $this->request->getParam('fieldId');
        $query = ['field' => $fieldId];

        $paging = app()->catalogService()
            ->loadAdminOptionPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'platform/attribute/paging/admin/browse-option'
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

    /**
     * Create new catalog
     */
    public function actionCreate()
    {
        $fieldId = $this->request->getParam('fieldId');

        $form = new CreateAttributeOption();

        if ($this->request->isMethod('get')) {
            $form->setData(['field_id' => $fieldId]);
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            app()->catalogService()
                ->addFieldOption($data);

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', [
                'any'   => 'attribute/option/browse',
                'fieldId' => $data['field_id']]);
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
        $id = $this->request->getParam('id');

        $entry = app()->catalogService()
            ->findOptionById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find field");

        $form = new EditAttributeOption();

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
                'any'   => 'attribute/option/browse',
                'fieldId' => $data['field_id']]);
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
        $id = $this->request->getParam('id');

        $entry = app()->catalogService()
            ->findOptionById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Could not find option");

        $form = new DeleteAttributeOption();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $entry->delete();

            app()->cacheService()
                ->flush();

            app()->routing()->redirect('admin', [
                'any'   => 'attribute/option/browse',
                'fieldId' => $entry->getFieldId(),
            ]);
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
}