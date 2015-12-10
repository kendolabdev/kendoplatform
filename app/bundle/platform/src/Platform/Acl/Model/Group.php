<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_acl_group`
 */

namespace Platform\Acl\Model;

/**
 */
use Kendo\Model;

/**
 * Class Group
 * @package Platform\Acl\Model
 */
class Group extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('group_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('group_id', $value);
    }

    /**
     * @return null|string
     */
    public function getGroupId(){
       return $this->__get('group_id');
    }

    /**
     * @param $value
     */
    public function setGroupId($value){
       $this->__set('group_id', $value);
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
     * @return null|string
     */
    public function getGroupTitle(){
       return $this->__get('group_title');
    }

    /**
     * @param $value
     */
    public function setGroupTitle($value){
       $this->__set('group_title', $value);
    }

    /**
     * @return null|string
     */
    public function getGroupDescription(){
       return $this->__get('group_description');
    }

    /**
     * @param $value
     */
    public function setGroupDescription($value){
       $this->__set('group_description', $value);
    }

    /**
     * @return null|string
     */
    public function getSortOrder(){
       return $this->__get('sort_order');
    }

    /**
     * @param $value
     */
    public function setSortOrder($value){
       $this->__set('sort_order', $value);
    }

    /**
     * @return null|string
     */
    public function getFormClass(){
       return $this->__get('form_class');
    }

    /**
     * @param $value
     */
    public function setFormClass($value){
       $this->__set('form_class', $value);
    }

    /**
     * @return \Platform\Acl\Model\GroupTable
     */
    public function table(){
        return \App::table('platform_acl_group');
    }
    //END_TABLE_GENERATOR
}