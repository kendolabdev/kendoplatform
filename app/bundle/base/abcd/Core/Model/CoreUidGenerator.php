<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_core_uid_generator`
 */

namespace Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class CoreUidGenerator
 *
 * @package Core\Model
 */
class CoreUidGenerator extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('uid');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('uid', $value);
    }

    /**
     * @return null|string
     */
    public function getUid(){
       return $this->__get('uid');
    }

    /**
     * @param $value
     */
    public function setUid($value){
       $this->__set('uid', $value);
    }

    /**
     * @return \Core\Model\CoreUidGeneratorTable
     */
    public function table(){
        return \App::table('core.core_uid_generator');
    }
    //END_TABLE_GENERATOR
}