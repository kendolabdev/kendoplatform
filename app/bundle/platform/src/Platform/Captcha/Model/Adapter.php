<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_captcha_adapter`
 */

namespace Platform\Captcha\Model;

/**
 */
use Kendo\Model;

/**
 * Class Adapter
 * @package Platform\Captcha\Model
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
     * @return \Platform\Captcha\Model\AdapterTable
     */
    public function table(){
        return \App::table('platform_captcha_adapter');
    }
    //END_TABLE_GENERATOR
}