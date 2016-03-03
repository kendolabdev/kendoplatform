<?php

namespace Platform\Catalog\Controller\Admin;

use Platform\Catalog\Form\Admin\CreateAttributeField;
use Platform\Catalog\Form\Admin\DeleteAttributeField;
use Platform\Catalog\Form\Admin\EditAttributeField;
use Platform\Catalog\Form\Admin\FilterAttributeField;
use Platform\Catalog\Form\PluginBaseSetting;
use Kendo\Controller\AdminController;
use Kendo\Layout\BlockParams;

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
        \App::layouts()
            ->setPageName('admin_simple')
            ->setupSecondaryNavigation('admin', 'admin_attribute', 'admin_attribute_field');
    }

    /**
     * Browse all catalog
     */
    public function actionBrowse()
    {
        \App::layouts()
            ->setPageTitle('attribute.manage_fields')
            ->setPageButtons([
                [
                    'label' => 'attribute.add_new_field',
                    'props' => [
                        'href'  => \App::routing()->getUrl('admin', ['stuff' => 'attribute/field/create']),
                        'class' => 'btn btn-sm btn-danger'
                    ]]
            ]);

        $page = 1;
        $filter = new FilterAttributeField();

        $filter->isValid([
            'q' => $this->request->getParam('q'),
        ]);

        $query = $filter->getData();

        $paging = \App::catalogService()
            ->loadAdminFieldPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'layout/facade/paging-more',
            'item_path' => 'platform/attribute/paging/admin/browse-field'
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

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            \App::catalogService()
                ->addField($data);

            \App::cacheService()
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

        $entry = \App::catalogService()
            ->findFieldById($id);

        $plugin = $entry->getPlugin();

        $formClass = $plugin->getPluginSetting();


        $form = new $formClass([
            'field' => $entry,
        ]);

        if (!$form instanceof PluginBaseSetting) ;

        $form->setTitle('Field Setting: ' . $entry->getTitle());
        $form->setNote('Edit setting for <b>' . $entry->getCode() . '</b>');

        if ($this->request->isMethod('get')) {
            $form->load();
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $form->save();

            \App::cacheService()
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

        $entry = \App::catalogService()
            ->findFieldById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find field");

        $form = new EditAttributeField();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
            $data = $form->getData();

            $entry->setFromArray($data);

            $entry->save();

            \App::cacheService()
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

        $entry = \App::catalogService()
            ->findFieldById($id);


        if (!$entry)
            throw new \InvalidArgumentException("Could not find field");

        $form = new DeleteAttributeField();

        if ($this->request->isMethod('get')) {
            $form->setData($entry->toArray());
        }

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {

            $entry->delete();

            \App::cacheService()
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

        $paging = \App::catalogService()
            ->loadAdminOptionPaging($query, $page);

        $lp = new BlockParams([
            'base_path' => 'platform/attribute/controller/admin/field/browse-option',
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
}