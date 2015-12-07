<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_mail_adapter`
 */

namespace Mail\Model;

/**
 */
use Kendo\Model;

/**
 * Class MailAdapter
 *
 * @package Mail\Model
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
     * @return \Mail\Model\MailAdapterTable
     */
    public function table(){
        return \App::table('mail.mail_adapter');
    }
    //END_TABLE_GENERATOR
}