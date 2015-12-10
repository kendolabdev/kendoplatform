<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_mail_adapter`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Model;

/**
 * Class Adapter
 * @package Platform\Mail\Model
 */
class Adapter extends Model{
    /**
     * @param string $prefix
     *
     * @return string
     */
    public function getNote($prefix = 'core.mail_transport_note_for_')
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
     * @return \Platform\Mail\Model\AdapterTable
     */
    public function table(){
        return \App::table('platform_mail_adapter');
    }
    //END_TABLE_GENERATOR
}