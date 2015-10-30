<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_layout_template`
 */

namespace Layout\Model;

/**
 */
use Picaso\Model;

/**
 * Class LayoutTemplate
 *
 * @package Layout\Model
 */
class LayoutTemplate extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('template_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('template_id', $value);
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
    public function getTemplateName(){
       return $this->__get('template_name');
    }

    /**
     * @param $value
     */
    public function setTemplateName($value){
       $this->__set('template_name', $value);
    }

    /**
     * @return null|string
     */
    public function getParentTemplateId(){
       return $this->__get('parent_template_id');
    }

    /**
     * @param $value
     */
    public function setParentTemplateId($value){
       $this->__set('parent_template_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSuperTemplateId(){
       return $this->__get('super_template_id');
    }

    /**
     * @param $value
     */
    public function setSuperTemplateId($value){
       $this->__set('super_template_id', $value);
    }

    /**
     * @return \Layout\Model\LayoutTemplateTable
     */
    public function table(){
        return \App::table('layout.layout_template');
    }
    //END_TABLE_GENERATOR
}