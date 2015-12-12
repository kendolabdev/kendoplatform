<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_type`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class CoreType
 *
 * @package Core\Model
 */
class CoreType extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('type_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('type_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTypeId()
    {
        return $this->__get('type_id');
    }

    /**
     * @param $value
     */
    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value)
    {
        $this->__set('name', $value);
    }

    /**
     * @return null|string
     */
    public function isPoster()
    {
        return $this->__get('is_poster');
    }

    /**
     * @return null|string
     */
    public function getPoster()
    {
        return $this->__get('is_poster');
    }

    /**
     * @param $value
     */
    public function setPoster($value)
    {
        $this->__set('is_poster', $value);
    }

    /**
     * @return null|string
     */
    public function getModuleName()
    {
        return $this->__get('module_name');
    }

    /**
     * @param $value
     */
    public function setModuleName($value)
    {
        $this->__set('module_name', $value);
    }

    /**
     * @return null|string
     */
    public function getHasAttributeCatalog()
    {
        return $this->__get('has_attribute_catalog');
    }

    /**
     * @param $value
     */
    public function setHasAttributeCatalog($value)
    {
        $this->__set('has_attribute_catalog', $value);
    }

    /**
     * @return null|string
     */
    public function getTableName()
    {
        return $this->__get('table_name');
    }

    /**
     * @param $value
     */
    public function setTableName($value)
    {
        $this->__set('table_name', $value);
    }

    /**
     * @return \Platform\Core\Model\CoreTypeTable
     */
    public function table()
    {
        return \App::table('platform_core_type');
    }
    //END_TABLE_GENERATOR
}