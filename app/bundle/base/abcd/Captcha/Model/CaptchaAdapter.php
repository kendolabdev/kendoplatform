<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_captcha_adapter`
 */

namespace Captcha\Model;

/**
 */
use Kendo\Model;

/**
 * Class CaptchaAdapter
 *
 * @package Captcha\Model
 */
class CaptchaAdapter extends Model
{

    /**
     * @param string $prefix
     *
     * @return string
     */
    public function getNote($prefix = 'core.captcha_adapter_note_for_')
    {
        return \App::text($prefix . $this->getId());
    }

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
     * @return \Captcha\Model\CaptchaAdapterTable
     */
    public function table(){
        return \App::table('captcha.captcha_adapter');
    }
    //END_TABLE_GENERATOR
}