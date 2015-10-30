<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_setting`
 */

namespace Setting\Model;

/**
 */
use Picaso\Model;

/**
 * Class Setting
 *
 * @package Setting\Model
 */
class Setting extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('setting_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('setting_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSettingId(){
       return $this->__get('setting_id');
    }

    /**
     * @param $value
     */
    public function setSettingId($value){
       $this->__set('setting_id', $value);
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
    public function getValueText(){
       return $this->__get('value_text');
    }

    /**
     * @param $value
     */
    public function setValueText($value){
       $this->__set('value_text', $value);
    }

    /**
     * @return \Setting\Model\SettingTable
     */
    public function table(){
        return \App::table('setting');
    }
    //END_TABLE_GENERATOR
}