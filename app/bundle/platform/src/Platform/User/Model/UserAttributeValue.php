<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_user_attribute_value`
 */

namespace Platform\User\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\UserAttributeValue
 *
 * @package Platform\User\Model
 */
class UserAttributeValue extends Model
{
    // PUT YOUR CODE HERE

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
    public function getItemId(){
       return $this->__get('item_id');
    }

    /**
     * @param $value
     */
    public function setItemId($value){
       $this->__set('item_id', $value);
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
    public function getValue(){
       return $this->__get('value');
    }

    /**
     * @param $value
     */
    public function setValue($value){
       $this->__set('value', $value);
    }

    /**
     * @return null|string
     */
    public function getValueInt(){
       return $this->__get('value_int');
    }

    /**
     * @param $value
     */
    public function setValueInt($value){
       $this->__set('value_int', $value);
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
     * @return null|string
     */
    public function getValueDate(){
       return $this->__get('value_date');
    }

    /**
     * @param $value
     */
    public function setValueDate($value){
       $this->__set('value_date', $value);
    }

    /**
     * @return null|string
     */
    public function getValueDecimal(){
       return $this->__get('value_decimal');
    }

    /**
     * @param $value
     */
    public function setValueDecimal($value){
       $this->__set('value_decimal', $value);
    }

    /**
     * @return \Platform\User\Model\UserAttributeValueTable
     */
    public function table(){
        return app()->table('platform_user_attribute_value');
    }
    //END_TABLE_GENERATOR
}