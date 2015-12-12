<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_section_map`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Model;

/**
 * Class CatalogSectionMap
 *
 * @package Platform\Catalog\Model
 */
class CatalogSectionMap extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('map_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('map_id', $value);
    }

    /**
     * @return null|string
     */
    public function getMapId()
    {
        return $this->__get('map_id');
    }

    /**
     * @param $value
     */
    public function setMapId($value)
    {
        $this->__set('map_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCatalogId()
    {
        return $this->__get('catalog_id');
    }

    /**
     * @param $value
     */
    public function setCatalogId($value)
    {
        $this->__set('catalog_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionId()
    {
        return $this->__get('section_id');
    }

    /**
     * @param $value
     */
    public function setSectionId($value)
    {
        $this->__set('section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSortOrder()
    {
        return $this->__get('sort_order');
    }

    /**
     * @param $value
     */
    public function setSortOrder($value)
    {
        $this->__set('sort_order', $value);
    }

    /**
     * @return \Platform\Catalog\Model\CatalogSectionMapTable
     */
    public function table()
    {
        return \App::table('platform_catalog_section_map');
    }
    //END_TABLE_GENERATOR
}