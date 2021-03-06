<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_aggregate`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class Aggregate
 *
 * @package Core\Model
 */
class Aggregate extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('id', $value);
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
    public function getValue()
    {
        return $this->__get('value');
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->__set('value', $value);
    }

    /**
     * @return \Platform\Core\Model\AggregateTable
     */
    public function table()
    {
        return app()->table('core.aggregate');
    }
    //END_TABLE_GENERATOR
}