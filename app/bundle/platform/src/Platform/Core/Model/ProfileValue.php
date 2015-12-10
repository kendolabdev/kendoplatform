<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_core_profile_value`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class ProfileValue
 * @package Platform\Core\Model
 */
class ProfileValue extends Model{
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
    public function getProfileId(){
       return $this->__get('profile_id');
    }

    /**
     * @param $value
     */
    public function setProfileId($value){
       $this->__set('profile_id', $value);
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
     * @return \Platform\Core\Model\ProfileValueTable
     */
    public function table(){
        return \App::table('platform_core_profile_value');
    }
    //END_TABLE_GENERATOR
}