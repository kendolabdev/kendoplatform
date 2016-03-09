<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_core_service`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class CoreService
 * @package Platform\Core\Model
 */
class CoreService extends Model{
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
    public function getClassName(){
       return $this->__get('class_name');
    }

    /**
     * @param $value
     */
    public function setClassName($value){
       $this->__set('class_name', $value);
    }

    /**
     * @return null|string
     */
    public function getPackageName(){
       return $this->__get('package_name');
    }

    /**
     * @param $value
     */
    public function setPackageName($value){
       $this->__set('package_name', $value);
    }

    /**
     * @return \Platform\Core\Model\CoreServiceTable
     */
    public function table(){
        return app()->table('platform_core_service');
    }
    //END_TABLE_GENERATOR
}