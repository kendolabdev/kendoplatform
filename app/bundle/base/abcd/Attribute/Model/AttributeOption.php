<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_attribute_option`
 */

namespace Attribute\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class AttributeOption
 *
 * @package Attribute\Model
 */
class AttributeOption extends Model implements UniqueId
{
    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->getOptionName();
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getOptionName();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'attribute.attribute_option';
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

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('option_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('option_id', $value);
    }

    /**
     * @return null|string
     */
    public function getOptionId(){
       return $this->__get('option_id');
    }

    /**
     * @param $value
     */
    public function setOptionId($value){
       $this->__set('option_id', $value);
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
    public function getOptionName(){
       return $this->__get('option_name');
    }

    /**
     * @param $value
     */
    public function setOptionName($value){
       $this->__set('option_name', $value);
    }

    /**
     * @return \Attribute\Model\AttributeOptionTable
     */
    public function table(){
        return \App::table('attribute.attribute_option');
    }
    //END_TABLE_GENERATOR
}