<?php

namespace Platform\Catalog\Service;

use Platform\Catalog\Form\AttributeCustomForm;
use Platform\Catalog\Form\AttributeInternalForm;
use Platform\Catalog\Model\AttributeField;
use Platform\Catalog\Model\AttributeFieldMap;
use Platform\Catalog\Model\AttributeOption;
use Platform\Catalog\Model\AttributePlugin;
use Platform\Catalog\Model\AttributeSection;
use Platform\Catalog\Model\AttributeSectionMap;
use Platform\Catalog\Model\AttributeCatalog;
use Platform\Core\Model\CoreType;
use Kendo\Content\CatalogInterface;
use Kendo\Content\PosterInterface;
use Kendo\Html\FormField;

/**
 * Class AttributeService
 *
 * @package Attribute\Service
 */
class CatalogService
{

    /**
     * @param CatalogInterface $subject
     *
     * @return array
     */
    public function getAbout($subject)
    {

        $form = $this->loadCatalogForm($subject);

        $data = $this->loadAttributeValue($subject, []);

        $form->setData($data);

        return $form;
    }

    // load list field name by id

    /**
     * @param string $contentId
     *
     * @return array
     */
    public function loadFieldIdConfig($contentId = 'user')
    {
        return \App::cacheService()
            ->get(['attribute', 'loadFieldIdConfig', $contentId], 0, function () use ($contentId) {
                return $this->_loadFieldIdConfig($contentId);
            });
    }

    /**
     * @param string $contentId
     *
     * @return array
     */
    public function _loadFieldIdConfig($contentId = 'user')
    {

        $fields = \App::table('attribute.attribute_field')
            ->select()
            ->where('content_id=?', $contentId)
            ->all();

        $result = [];

        foreach ($fields as $field) {
            if (!$field instanceof AttributeField) continue;

            $result[ $field->getId() ] = $field->toConfig();
        }

        return $result;
    }

    /**
     * @param CatalogInterface $item
     * @param array            $fieldIdList
     *
     * @return array
     */
    public function loadAttributeValue($item, $fieldIdList)
    {
        $fieldConfig = $this->loadFieldIdConfig();

        $select = $item->getAttributeValueTable()
            ->select()
            ->where('item_id=?', (string)$item->getId())
            ->columns('field_id, value');

        if (!empty($fieldIdList))
            $select->where('field_id IN ?', $fieldIdList);

        $rows = $select->toAssocs();

        $result = [];

        // load field name by field id


        foreach ($rows as $row) {
            if (empty($fieldConfig[ $row['field_id'] ])) continue;

            $itemConfig = $fieldConfig[ $row['field_id'] ];

            if ($itemConfig['multi']) {
                $result[ $itemConfig['name'] ][] = $row['value'];
            } else {
                $result[ $itemConfig['name'] ] = $row['value'];
            }
        }

        return $result;
    }

    /**
     * @param CatalogInterface|PosterInterface $item
     * @param                     $data
     */
    public function updateItemAttribute($item, $data = [])
    {
        $catalogId = $item->getCatalogId();

        if (!$catalogId) return;

        $form = $this->getInternalFormByCatalogId($catalogId);
        $form->setData($data);

        $atTable = $item->getAttributeValueTable();

        $atTable->delete()
            ->where('item_id=?', $item->getId())
            ->execute();

        $maps = [];

        foreach ($form->getElements() as $element) {

            if (!$element instanceof FormField) continue;

            $fieldId = $element->getFieldId();

            if (!$fieldId) continue;

            $maps [ $fieldId ] = $element->getValue();
        }

        foreach ($maps as $fieldId => $value) {
            $entry = $atTable->fetchNew([
                'item_id'  => $item->getId(),
                'field_id' => $fieldId,
                'value'    => $value,
            ]);
            $entry->save();
        }


    }


    /**
     * @param $catalogId
     *
     * @return \Platform\Catalog\Form\AttributeInternalForm
     */
    public function getInternalFormByCatalogId($catalogId)
    {
        $form = new AttributeInternalForm();
        $form->addElements($this->loadInternalListFieldByCatalogId($catalogId));

        return $form;
    }

    /**
     * @param $catalogId
     *
     * @return array
     */
    public function loadInternalListFieldByCatalogId($catalogId)
    {
        return \App::cacheService()
            ->get(['attribute', 'loadInternalListFieldByCatalogId', $catalogId], 0, function () use ($catalogId) {
                return $this->_loadInternalListFieldByCatalogId($catalogId);
            });
    }

    /**
     * @param $catalogId
     *
     * @return array
     */
    public function _loadInternalListFieldByCatalogId($catalogId)
    {
        $catalog = $this->findCatalogById($catalogId);

        $elements = [];

        foreach ($catalog->getListSection() as $section) {
            if (!$section instanceof AttributeSection) continue;
            foreach ($section->getListField() as $field) {
                if (!$field instanceof AttributeField) continue;
                $element = $field->toElement();
                if (!empty($element))
                    $elements[] = $element;
            }
        }

        return $elements;

    }

    /**
     * @param $catalogId
     * @param $sectionId
     *
     * @return \Platform\Catalog\Model\AttributeSectionMap
     */
    public function findSectionMap($catalogId, $sectionId)
    {
        return \App::table('attribute.attribute_section_map')
            ->select()
            ->where('catalog_id=?', $catalogId)
            ->where('section_id=?', $sectionId)
            ->one();
    }

    /**
     * @param $sectionId
     * @param $fieldId
     *
     * @return \Platform\Catalog\Model\AttributeFieldMap
     */
    public function findFieldMap($sectionId, $fieldId)
    {
        return \App::table('attribute.attribute_field_map')
            ->select()
            ->where('section_id=?', $sectionId)
            ->where('field_id=?', $fieldId)
            ->one();
    }

    /**
     * @param $sectionId
     * @param $fieldId
     *
     * @return \Platform\Catalog\Model\AttributeFieldMap
     */
    public function addFieldMap($sectionId, $fieldId)
    {
        $entry = $this->findFieldMap($sectionId, $fieldId);

        if (!$entry) {
            $entry = new AttributeFieldMap([
                'section_id'      => $sectionId,
                'field_id'        => $fieldId,
                'sort_order'      => 1,
                'ext_params_text' => '[]',
            ]);

            $entry->save();
        }

        return $entry;
    }

    /**
     * @param $catalogId
     * @param $sectionId
     */
    public function removeSectionMap($catalogId, $sectionId)
    {
        \App::table('attribute.attribute_section_map')
            ->delete()
            ->where('catalog_id=?', $catalogId)
            ->where('section_id=?', $sectionId)
            ->execute();
    }

    /**
     * @param $sectionId
     * @param $fieldId
     */
    public function removeFieldMap($sectionId, $fieldId)
    {
        \App::table('attribute.attribute_field_map')
            ->delete()
            ->where('section_id=?', $sectionId)
            ->where('field_id=?', $fieldId)
            ->execute();
    }

    /**
     * @param $catalogId
     * @param $sectionId
     *
     * @return \Platform\Catalog\Model\AttributeSectionMap
     */
    public function addSectionMap($catalogId, $sectionId)
    {
        $entry = $this->findSectionMap($catalogId, $sectionId);

        if (!$entry) {
            $entry = new AttributeSectionMap([
                'catalog_id'      => $catalogId,
                'section_id'      => $sectionId,
                'sort_order'      => 1,
                'ext_params_text' => '[]',
            ]);

            $entry->save();
        }

        return $entry;
    }

    /**
     * @param $fieldId
     *
     * @return array
     */
    public function loadOptionByFieldId($fieldId)
    {

        $options = [];

        $select = \App::table('attribute.attribute_option')
            ->select()
            ->where('field_id=?', $fieldId)
            ->order('option_name', 1);

        $items = $select->all();

        foreach ($items as $item) {
            if (!$item instanceof AttributeOption) continue;

            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getName()
            ];
        }

        return $options;
    }

    /**
     * @param string $sectionId
     *
     * @return array
     */
    public function getListFieldBySectionId($sectionId)
    {
        return \App::table('attribute.attribute_field')
            ->select('f')
            ->join(':attribute_field_map', 'm', 'f.field_id=m.field_id', null, null)
            ->where('m.section_id=?', (string)$sectionId)
            ->order('m.sort_order', 1)
            ->columns('f.*')
            ->all();
    }

    /**
     * @param $catalogId
     *
     * @return array
     */
    public function getListSectionByCatalogId($catalogId)
    {
        return \App::table('attribute.attribute_section')
            ->select('s')
            ->join(':attribute_section_map', 'm', 's.section_id=m.section_id', null, null)
            ->where('m.catalog_id=?', (string)$catalogId)
            ->order('m.sort_order', 1)
            ->all();
    }


    /**
     * @param CatalogInterface $subject
     *
     * @return \Platform\Catalog\Form\AttributeCustomForm
     */
    public function loadCatalogForm($subject)
    {
        $form = new AttributeCustomForm(['forItem' => $subject]);

        return $form;
    }

    /**
     * @param string $catalogId
     *
     * @return array
     */
    public function loadCatalogElements($catalogId)
    {
        $catalog = $this->findCatalogById($catalogId);

        if (!$catalog)
            return [];

        $listSection = $catalog->getListSection();

        $elements = [];

        foreach ($listSection as $section) {
            if (!$section instanceof AttributeSection) continue;

            $listField = $section->getListField();

            if (!empty($listField))
                $elements[] = $section->toElement();

            foreach ($listField as $field) {
                if (!$field instanceof AttributeField) continue;
                $element = $field->toElement();
                if (!empty($element))
                    $elements[] = $element;
            }
        }

        return $elements;
    }

    /**
     * @param string $id
     *
     * @return \Platform\Catalog\Model\AttributeOption
     */
    public function findOptionById($id)
    {
        return \App::table('attribute.attribute_option')
            ->findById((string)$id);
    }

    /**
     * @param string $id
     *
     * @return \Platform\Catalog\Model\AttributePlugin
     */
    public function findPluginById($id)
    {
        return \App::table('attribute.attribute_plugin')
            ->findById((string)$id);
    }


    /**
     * @param string $id
     *
     * @return \Platform\Catalog\Model\AttributeField
     */
    public function findFieldById($id)
    {
        return \App::table('attribute.attribute_field')
            ->findById(intval($id));
    }

    /**
     * @param string $code
     * @param string $contentId
     *
     * @return \Platform\Catalog\Model\AttributeField
     */
    public function findFieldByCode($code, $contentId)
    {
        return \App::table('attribute.attribute_field')
            ->select()
            ->where('field_code=?', (string)$code)
            ->where('content_id=?', (string)$contentId)
            ->one();
    }


    /**
     * @param string $id
     *
     * @return \Platform\Catalog\Model\AttributeSection
     */
    public function findSectionById($id)
    {
        return \App::table('attribute.attribute_section')
            ->findById(intval($id));
    }

    /**
     * @param string $code
     * @param string $contentId
     *
     * @return \Platform\Catalog\Model\AttributeSection
     */
    public function findSectionByCode($code, $contentId)
    {
        return \App::table('attribute.attribute_section')
            ->select()
            ->where('section_code=?', (string)$code)
            ->where('content_id=?', (string)$contentId)
            ->one();
    }

    /**
     * @param string $id
     *
     * @return \Platform\Catalog\Model\AttributeCatalog
     */
    public function findCatalogById($id)
    {
        return \App::table('attribute.attribute_catalog')
            ->findById(intval($id));
    }

    /**
     * @param string $code
     * @param string $contentId
     *
     * @return \Platform\Catalog\Model\AttributeCatalog
     */
    public function findCatalogByCode($code, $contentId)
    {
        return \App::table('attribute.attribute_catalog')
            ->select()
            ->where('catalog_code=?', (string)$code)
            ->where('content_id=?', (string)$contentId)
            ->one();
    }

    /**
     * @param array $data
     *
     * @return \Platform\Catalog\Model\AttributeOption
     */
    public function addFieldOption($data = [])
    {
        if (empty($data['field_id']) or empty($data['option_name']))
            throw new \InvalidArgumentException("Missing parameters [field_id, option_name] ");

        if (null == $this->findFieldById($data['field_id']))
            throw new \InvalidArgumentException("Invalid parameters [field_id]");

        $data = array_merge([], $data);

        $entry = new AttributeOption($data);

        $entry->save();

        return $entry;
    }

    /**
     * @param array $data
     *
     * @return \Platform\Catalog\Model\AttributePlugin
     */
    public function addPlugin($data = [])
    {
        if (empty($data['plugin_name']) or empty($data['plugin_id']))
            throw new \InvalidArgumentException("Missing parameters [plugin_name, plugin_id] ");

        if (null != $this->findPluginById($data['plugin_id']))
            throw new \InvalidArgumentException("Duplicate [plugin_id]");

        $data = array_merge([], $data);

        $entry = new AttributePlugin($data);

        $entry->save();

        return $entry;
    }


    /**
     * @param array $data
     *
     * @return \Platform\Catalog\Model\AttributeField
     */
    public function addField($data = [])
    {
        if (empty($data['field_name'])
            or empty($data['field_code'])
                or empty($data['content_id'])
                or empty($data['plugin_id'])
        )
            throw new \InvalidArgumentException("Missing parameters [field_name, field_code, content_id,plugin_id");

        $data['field_code'] = preg_replace('#\W+#', '_', strtolower($data['field_code']));

        if (null != $this->findFieldByCode($data['field_code'], $data['content_id']))
            throw new \InvalidArgumentException("Duplicate [field_code, content_id]");

        $data = array_merge([], $data);

        $entry = new AttributeField($data);

        $entry->save();

        return $entry;
    }

    /**
     * @param array $data
     *
     * @return \Platform\Catalog\Model\AttributeSection
     */
    public function addSection($data = [])
    {
        if (empty($data['section_name'])
            or empty($data['content_id'])
            or empty($data['section_code'])
        )
            throw new \InvalidArgumentException("Missing parameters [section_name, section_code, content_id] ");

        $data['section_code'] = preg_replace('#\W+#', '_', strtolower($data['section_code']));

        if (null != $this->findSectionByCode($data['section_code'], $data['content_id']))
            throw new \InvalidArgumentException("Duplicate [section_code, content_id]");

        $data = array_merge([], $data);

        $entry = new AttributeSection($data);

        $entry->save();

        return $entry;
    }

    /**
     * @param array $data
     *
     * @return \Platform\Catalog\Model\AttributeCatalog
     */
    public function addCatalog($data = [])
    {
        if (empty($data['catalog_name'])
            or empty($data['catalog_code'])
            or empty($data['content_id'])
        )
            throw new \InvalidArgumentException("Missing parameters [catalog_name, catalog_code, content_id] ");

        $data['catalog_code'] = preg_replace('#\W+#', '_', strtolower($data['catalog_code']));

        if (null != $this->findCatalogByCode($data['catalog_code'], $data['content_id']))
            throw new \InvalidArgumentException("Duplicate [catalog_code, content_id]");

        $data = array_merge([], $data);

        $entry = new AttributeCatalog($data);

        $entry->save();

        return $entry;
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminOptionPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('attribute.attribute_option')->select();

        if (!empty($query['field'])) {
            $select->where('field_id=?', (string)$query['field']);
        }

        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminFieldPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('attribute.attribute_field')
            ->select();

        if (!empty($query['q'])) {
            $select->where('field_name like ?', '%' . (string)$query['q'] . '%');
        }


        if (!empty($query['excludes'])) {
            $select->where('field_id NOT IN ?', (array)$query['excludes']);
        }

        if (!empty($query['content_id'])) {
            $select->where('content_id=?', (string)$query['content_id']);
        }

        return $select->paging($page, $limit);

    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminSectionPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('attribute.attribute_section')->select();

        if (!empty($query['content_id'])) {
            $select->where('content_id=?', (string)$query['content_id']);
        }

        if (!empty($query['q'])) {
            $select->where('section_name like ?', '%' . (string)$query['q'] . '%');
        }

        if (!empty($query['excludes'])) {
            $select->where('section_id NOT IN ?', $query['excludes']);
        }

        return $select->paging($page, $limit);

    }


    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminCatalogPaging($query = [], $page = 1, $limit = 12)
    {
        $select = \App::table('attribute.attribute_catalog')->select();

        if (!empty($query['content_id'])) {
            $select->where('content_id=?', (string)$query['content_id']);
        }

        if (!empty($query['q'])) {
            $select->where('catalog_name like ?', '%' . (string)$query['q'] . '%');
        }

        return $select->paging($page, $limit);

    }

    /**
     * @return array
     */
    public function loadContentTypeOptions()
    {
        return \App::cacheService()
            ->get(['attribute', 'loadContentTypeOptions'], 0, function () {
                return $this->_loadContentTypeOptions();
            });
    }

    /**
     * @return array
     */
    public function _loadContentTypeOptions()
    {
        $select = \App::table('platform_core_type')
            ->select()
            ->where('module_name in ?', \App::extensions()->getActiveModuleNames())
            ->where('has_attribute_catalog=?', 1);


        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof CoreType) continue;
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getName(),
            ];
        }

        return $options;
    }

    /**
     * @return array
     */
    public function loadAdminCatalogOptions()
    {
        return \App::cacheService()
            ->get(['attribute', '_loadAdminCatalogOptions'], 0, function () {
                return $this->_loadAdminCatalogOptions();
            });
    }

    /**
     * @return array
     */
    public function _loadAdminCatalogOptions()
    {
        $select = \App::table('attribute.attribute_catalog')
            ->select();


        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof AttributeCatalog) continue;
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getTitle(),
            ];
        }

        return $options;
    }

    /**
     * @return mixed
     */
    public function loadAdminPluginOptions()
    {
        return \App::cacheService()
            ->get(['attribute', 'loadAdminPluginOptions'], 0, function () {
                return $this->_loadAdminPluginOptions();
            });
    }

    /**
     * @return array
     */
    public function _loadAdminPluginOptions()
    {
        $select = \App::table('attribute.attribute_plugin')
            ->select()
            ->order('plugin_name', 1);


        $items = $select->all();

        $options = [];

        foreach ($items as $item) {
            if (!$item instanceof AttributePlugin) continue;
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getTitle(),
            ];
        }

        return $options;
    }

    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListPluginByModuleName($moduleList)
    {
        return \App::table('attribute.attribute_plugin')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }
}