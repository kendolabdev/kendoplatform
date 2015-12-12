<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_value`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class CoreValue
 *
 * @package Core\Model
 */
class CoreValue extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('parent_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentId()
    {
        return $this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentType()
    {
        return $this->__get('parent_type');
    }

    /**
     * @param $value
     */
    public function setParentType($value)
    {
        $this->__set('parent_type', $value);
    }

    /**
     * @return null|string
     */
    public function getValuesText()
    {
        return $this->__get('values_text');
    }

    /**
     * @param $value
     */
    public function setValuesText($value)
    {
        $this->__set('values_text', $value);
    }

    /**
     * @return \Platform\Core\Model\CoreValueTable
     */
    public function table()
    {
        return \App::table('platform_core_value');
    }
    //END_TABLE_GENERATOR
}