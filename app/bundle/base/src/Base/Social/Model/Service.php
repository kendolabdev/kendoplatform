<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_social_service`
 */

namespace Base\Social\Model;

/**
 */
use Kendo\Model;

/**
 * Class Service
 * @package Base\Social\Model
 */
class Service extends Model{
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
    public function isActive(){
       return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive(){
       return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value){
       $this->__set('is_active', $value);
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
    public function getSettingForm(){
       return $this->__get('setting_form');
    }

    /**
     * @param $value
     */
    public function setSettingForm($value){
       $this->__set('setting_form', $value);
    }

    /**
     * @return null|string
     */
    public function getIonIconClass(){
       return $this->__get('ion_icon_class');
    }

    /**
     * @param $value
     */
    public function setIonIconClass($value){
       $this->__set('ion_icon_class', $value);
    }

    /**
     * @return \Base\Social\Model\ServiceTable
     */
    public function table(){
        return \App::table('base_social_service');
    }
    //END_TABLE_GENERATOR
}