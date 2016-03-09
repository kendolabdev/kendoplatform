<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_mail_adapter`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\MailAdapter
 *
 * @package Platform\Mail\Model
 */
class MailAdapter extends Model
{
    /**
     * @param string $prefix
     *
     * @return string
     */
    public function getNote($prefix = 'core.mail_transport_note_for_')
    {
        return app()->text($prefix . $this->getId());
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
     * @return \Platform\Mail\Model\MailAdapterTable
     */
    public function table(){
        return app()->table('platform_mail_adapter');
    }
    //END_TABLE_GENERATOR
}