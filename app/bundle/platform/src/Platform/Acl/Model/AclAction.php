<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_acl_action`
 */

namespace Platform\Acl\Model;

/**
 */
use Kendo\Model;

/**
 * Class AclAction
 *
 * @package Platform\Acl\Model
 */
class AclAction extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('action_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('action_id', $value);
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
    public function getGroupName(){
       return $this->__get('group_name');
    }

    /**
     * @param $value
     */
    public function setGroupName($value){
       $this->__set('group_name', $value);
    }

    /**
     * @return null|string
     */
    public function getActionName(){
       return $this->__get('action_name');
    }

    /**
     * @param $value
     */
    public function setActionName($value){
       $this->__set('action_name', $value);
    }

    /**
     * @return null|string
     */
    public function getComment(){
       return $this->__get('comment');
    }

    /**
     * @param $value
     */
    public function setComment($value){
       $this->__set('comment', $value);
    }

    /**
     * @return \Platform\Acl\Model\AclActionTable
     */
    public function table(){
        return app()->table('platform_acl_action');
    }
    //END_TABLE_GENERATOR
}