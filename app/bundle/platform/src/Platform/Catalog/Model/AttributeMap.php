<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_attribute_map`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Model;

/**
 * Class AttributeMap
 *
 * @package Attribute\Model
 */
class AttributeMap extends Model
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
    public function getFieldId()
    {
        return $this->__get('field_id');
    }

    /**
     * @param $value
     */
    public function setFieldId($value)
    {
        $this->__set('field_id', $value);
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
     * @return null|string
     */
    public function isActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value)
    {
        $this->__set('is_active', $value);
    }

    /**
     * @return \Platform\Catalog\Model\AttributeMapTable
     */
    public function table()
    {
        return app()->table('attribute.attribute_map');
    }
    //END_TABLE_GENERATOR
}