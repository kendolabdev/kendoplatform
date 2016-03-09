<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_hook`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class CoreHook
 *
 * @package Core\Model
 */
class CoreHook extends Model
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
    public function getEventName(){
       return $this->__get('event_name');
    }

    /**
     * @param $value
     */
    public function setEventName($value){
       $this->__set('event_name', $value);
    }

    /**
     * @return null|string
     */
    public function getServiceName(){
       return $this->__get('service_name');
    }

    /**
     * @param $value
     */
    public function setServiceName($value){
       $this->__set('service_name', $value);
    }

    /**
     * @return null|string
     */
    public function getLoadOrder(){
       return $this->__get('load_order');
    }

    /**
     * @param $value
     */
    public function setLoadOrder($value){
       $this->__set('load_order', $value);
    }

    /**
     * @return null|string
     */
    public function getModuleName(){
       return $this->__get('module_name');
    }

    /**
     * @param $value
     */
    public function setModuleName($value){
       $this->__set('module_name', $value);
    }

    /**
     * @return \Platform\Core\Model\CoreHookTable
     */
    public function table(){
        return app()->table('platform_core_hook');
    }
    //END_TABLE_GENERATOR
}