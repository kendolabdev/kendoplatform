<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_aggregate`
 */

namespace Core\Model;

/**
 */
use Picaso\Model;

/**
 * Class CoreAggregate
 *
 * @package Core\Model
 */
class CoreAggregate extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('id', $value);
    }

    /**
     * @return null|string
     */
    public function getName(){
       return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value){
       $this->__set('name', $value);
    }

    /**
     * @return null|string
     */
    public function getValue(){
       return $this->__get('value');
    }

    /**
     * @param $value
     */
    public function setValue($value){
       $this->__set('value', $value);
    }

    /**
     * @return \Core\Model\CoreAggregateTable
     */
    public function table(){
        return \App::table('core.core_aggregate');
    }
    //END_TABLE_GENERATOR
}