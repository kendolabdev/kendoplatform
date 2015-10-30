<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_uid_generator`
 */

namespace Core\Model;

/**
 */
use Picaso\Model;

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
     * @return \Core\Model\UidGeneratorTable
     */
    public function table()
    {
        return \App::table('core.uid_generator');
    }
    //END_TABLE_GENERATOR
}