<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_core_profile_field`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class ProfileField
 * @package Platform\Core\Model
 */
class ProfileField extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('field_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('field_id', $value);
    }

    /**
     * @return null|string
     */
    public function getFieldId(){
       return $this->__get('field_id');
    }

    /**
     * @param $value
     */
    public function setFieldId($value){
       $this->__set('field_id', $value);
    }

    /**
     * @return null|string
     */
    public function getContentType(){
       return $this->__get('content_type');
    }

    /**
     * @param $value
     */
    public function setContentType($value){
       $this->__set('content_type', $value);
    }

    /**
     * @return null|string
     */
    public function getFieldName(){
       return $this->__get('field_name');
    }

    /**
     * @param $value
     */
    public function setFieldName($value){
       $this->__set('field_name', $value);
    }

    /**
     * @return null|string
     */
    public function getPluginId(){
       return $this->__get('plugin_id');
    }

    /**
     * @param $value
     */
    public function setPluginId($value){
       $this->__set('plugin_id', $value);
    }

    /**
     * @return null|string
     */
    public function isRequired(){
       return $this->__get('is_required');
    }

    /**
     * @return null|string
     */
    public function getRequired(){
       return $this->__get('is_required');
    }

    /**
     * @param $value
     */
    public function setRequired($value){
       $this->__set('is_required', $value);
    }

    /**
     * @return null|string
     */
    public function isMultiple(){
       return $this->__get('is_multiple');
    }

    /**
     * @return null|string
     */
    public function getMultiple(){
       return $this->__get('is_multiple');
    }

    /**
     * @param $value
     */
    public function setMultiple($value){
       $this->__set('is_multiple', $value);
    }

    /**
     * @return null|string
     */
    public function getDataType(){
       return $this->__get('data_type');
    }

    /**
     * @param $value
     */
    public function setDataType($value){
       $this->__set('data_type', $value);
    }

    /**
     * @return \Platform\Core\Model\ProfileFieldTable
     */
    public function table(){
        return \App::table('platform_core_profile_field');
    }
    //END_TABLE_GENERATOR
}