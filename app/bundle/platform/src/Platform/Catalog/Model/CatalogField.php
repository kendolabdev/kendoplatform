<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_field`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Model;

/**
 * Class CatalogField
 * @package Platform\Catalog\Model
 */
class CatalogField extends Model{
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
    public function getFieldCode(){
       return $this->__get('field_code');
    }

    /**
     * @param $value
     */
    public function setFieldCode($value){
       $this->__set('field_code', $value);
    }

    /**
     * @return null|string
     */
    public function getContentId(){
       return $this->__get('content_id');
    }

    /**
     * @param $value
     */
    public function setContentId($value){
       $this->__set('content_id', $value);
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
    public function getParamsText(){
       return $this->__get('params_text');
    }

    /**
     * @param $value
     */
    public function setParamsText($value){
       $this->__set('params_text', $value);
    }

    /**
     * @return \Platform\Catalog\Model\CatalogFieldTable
     */
    public function table(){
        return \App::table('platform_catalog_field');
    }
    //END_TABLE_GENERATOR
}