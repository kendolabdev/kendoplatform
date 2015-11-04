<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_layout_section_convert`
 */

namespace Layout\Model;

/**
 */
use Picaso\Model;

/**
 * Class LayoutSectionConvert
 * @package Layout\Model
 */
class LayoutSectionConvert extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('conver_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('conver_id', $value);
    }

    /**
     * @return null|string
     */
    public function getConverId(){
       return $this->__get('conver_id');
    }

    /**
     * @param $value
     */
    public function setConverId($value){
       $this->__set('conver_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTemplateId(){
       return $this->__get('template_id');
    }

    /**
     * @param $value
     */
    public function setTemplateId($value){
       $this->__set('template_id', $value);
    }

    /**
     * @return null|string
     */
    public function getFromId(){
       return $this->__get('from_id');
    }

    /**
     * @param $value
     */
    public function setFromId($value){
       $this->__set('from_id', $value);
    }

    /**
     * @return null|string
     */
    public function getToId(){
       return $this->__get('to_id');
    }

    /**
     * @param $value
     */
    public function setToId($value){
       $this->__set('to_id', $value);
    }

    /**
     * @return \Layout\Model\LayoutSectionConvertTable
     */
    public function table(){
        return \App::table('layout.layout_section_convert');
    }
    //END_TABLE_GENERATOR
}