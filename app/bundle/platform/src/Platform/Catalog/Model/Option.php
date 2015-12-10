<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_catalog_option`
 */

namespace Platform\Catalog\Model;

/**
 */
use Kendo\Model;

/**
 * Class Option
 * @package Platform\Catalog\Model
 */
class Option extends Model{
    // PUT YOUR CODE HERE

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
     * @return \Platform\Catalog\Model\OptionTable
     */
    public function table(){
        return \App::table('platform_catalog_option');
    }
    //END_TABLE_GENERATOR
}