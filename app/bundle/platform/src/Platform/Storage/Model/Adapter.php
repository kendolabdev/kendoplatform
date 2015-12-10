<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_storage_adapter`
 */

namespace Platform\Storage\Model;

/**
 */
use Kendo\Model;

/**
 * Class Adapter
 * @package Platform\Storage\Model
 */
class Adapter extends Model{
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
    public function getAdminForm(){
       return $this->__get('admin_form');
    }

    /**
     * @param $value
     */
    public function setAdminForm($value){
       $this->__set('admin_form', $value);
    }

    /**
     * @return \Platform\Storage\Model\AdapterTable
     */
    public function table(){
        return \App::table('platform_storage_adapter');
    }
    //END_TABLE_GENERATOR
}