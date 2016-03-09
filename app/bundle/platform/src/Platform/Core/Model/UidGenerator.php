<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_uid_generator`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class UidGenerator
 *
 * @package Core\Model
 */
class UidGenerator extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('uid');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('uid', $value);
    }

    /**
     * @return null|string
     */
    public function getUid()
    {
        return $this->__get('uid');
    }

    /**
     * @param $value
     */
    public function setUid($value)
    {
        $this->__set('uid', $value);
    }

    /**
     * @return \Platform\Core\Model\UidGeneratorTable
     */
    public function table()
    {
        return app()->table('core.uid_generator');
    }
    //END_TABLE_GENERATOR
}