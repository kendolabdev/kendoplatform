<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_attribute_field`
 */

namespace Attribute\Model;

/**
 */
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class AttributeField
 *
 * @package Attribute\Model
 */
class AttributeField extends Model implements UniqueId
{
    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->getFieldName();
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getFieldName();
    }

    /**
     * @return null|string
     */
    public function getCode()
    {
        return $this->getFieldCode();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'attribute.attribute_field';
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return [
            'id'   => $this->getId(),
            'type' => $this->getType(),
        ];
    }

    /**
     * @return \Attribute\Model\AttributePlugin
     */
    public function getPlugin()
    {
        return \App::attribute()
            ->findPluginById($this->getPluginId());
    }

    /**
     * Is multiple options
     *
     * @return bool
     */
    public function isPredefined()
    {
        return $this->getPlugin()->isPredefined() ? true : false;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return (array)json_decode($this->getParamsText(), true);


    }

    /**
     * @param array $data
     */
    public function setParams($data = [])
    {
        $this->setParamsText(json_encode($data));
    }

    /**
     * @return array|null
     */
    public function toElement()
    {
        $plugin = $this->getPlugin();

        if (!$plugin)
            return null;

        $params = (array)$this->getParams();

        $element = array_merge([
            'plugin'  => $this->getPluginId(),
            'name'    => $this->getCode(),
            'label'   => $this->getName(),
            'fieldId' => $this->getId(),
        ], $params);


        if (!empty($params['is_form_control'])) {
            $element['class'] = 'form-control';
        }

        if ($plugin->isPredefined()) {
            $element['options'] = \App::attribute()
                ->loadOptionByFieldId($this->getId());
        }

        return $element;
    }

    /**
     * @return array
     */
    public function toConfig()
    {
        $plugin = $this->getPlugin();

        return [
            'name'         => $this->getCode(),
            'multi'   => $plugin->isMultiple(),
            'predefined' => $plugin->isPredefined(),
        ];
    }

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
     * @return \Attribute\Model\AttributeFieldTable
     */
    public function table(){
        return \App::table('attribute.attribute_field');
    }
    //END_TABLE_GENERATOR
}