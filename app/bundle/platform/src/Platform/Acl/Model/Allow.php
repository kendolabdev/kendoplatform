<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_acl_allow`
 */

namespace Platform\Acl\Model;

/**
 */
use Kendo\Model;

/**
 * Class Allow
 * @package Platform\Acl\Model
 */
class Allow extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('allow_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('allow_id', $value);
    }

    /**
     * @return null|string
     */
    public function getAllowId(){
       return $this->__get('allow_id');
    }

    /**
     * @param $value
     */
    public function setAllowId($value){
       $this->__set('allow_id', $value);
    }

    /**
     * @return null|string
     */
    public function getRoleId(){
       return $this->__get('role_id');
    }

    /**
     * @param $value
     */
    public function setRoleId($value){
       $this->__set('role_id', $value);
    }

    /**
     * @return null|string
     */
    public function getActionId(){
       return $this->__get('action_id');
    }

    /**
     * @param $value
     */
    public function setActionId($value){
       $this->__set('action_id', $value);
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
     * @return \Platform\Acl\Model\AllowTable
     */
    public function table(){
        return \App::table('platform_acl_allow');
    }
    //END_TABLE_GENERATOR
}