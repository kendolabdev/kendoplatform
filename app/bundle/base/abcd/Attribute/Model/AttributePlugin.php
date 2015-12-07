<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_attribute_plugin`
 */

namespace Attribute\Model;

/**
 */
use Kendo\Model;

/**
 * Class AttributePlugin
 *
 * @package Attribute\Model
 */
class AttributePlugin extends Model
{
    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getPluginName();
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->getPluginName();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'attribute.attribute_plugin';
    }

    /**
     * @return array
     */
    public function  toTokenArray()
    {
        return [
            'id'   => $this->getId(),
            'type' => $this->getType(),
        ];
    }


    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('plugin_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('plugin_id', $value);
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
    public function getPluginName(){
       return $this->__get('plugin_name');
    }

    /**
     * @param $value
     */
    public function setPluginName($value){
       $this->__set('plugin_name', $value);
    }

    /**
     * @return null|string
     */
    public function isPredefined(){
       return $this->__get('is_predefined');
    }

    /**
     * @return null|string
     */
    public function getPredefined(){
       return $this->__get('is_predefined');
    }

    /**
     * @param $value
     */
    public function setPredefined($value){
       $this->__set('is_predefined', $value);
    }

    /**
     * @return null|string
     */
    public function isFormControl(){
       return $this->__get('is_form_control');
    }

    /**
     * @return null|string
     */
    public function getFormControl(){
       return $this->__get('is_form_control');
    }

    /**
     * @param $value
     */
    public function setFormControl($value){
       $this->__set('is_form_control', $value);
    }

    /**
     * @return null|string
     */
    public function getPluginSetting(){
       return $this->__get('plugin_setting');
    }

    /**
     * @param $value
     */
    public function setPluginSetting($value){
       $this->__set('plugin_setting', $value);
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
    public function getModuleName(){
       return $this->__get('module_name');
    }

    /**
     * @param $value
     */
    public function setModuleName($value){
       $this->__set('module_name', $value);
    }

    /**
     * @return \Attribute\Model\AttributePluginTable
     */
    public function table(){
        return \App::table('attribute.attribute_plugin');
    }
    //END_TABLE_GENERATOR
}