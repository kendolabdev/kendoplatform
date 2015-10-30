<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_layout_section`
 */

namespace Layout\Model;

/**
 */
use Picaso\Model;

/**
 * Class LayoutSection
 *
 * @package Layout\Model
 */
class LayoutSection extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('section_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionId(){
       return $this->__get('section_id');
    }

    /**
     * @param $value
     */
    public function setSectionId($value){
       $this->__set('section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getLayoutId(){
       return $this->__get('layout_id');
    }

    /**
     * @param $value
     */
    public function setLayoutId($value){
       $this->__set('layout_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionOrder(){
       return $this->__get('section_order');
    }

    /**
     * @param $value
     */
    public function setSectionOrder($value){
       $this->__set('section_order', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionActive(){
       return $this->__get('section_active');
    }

    /**
     * @param $value
     */
    public function setSectionActive($value){
       $this->__set('section_active', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionType(){
       return $this->__get('section_type');
    }

    /**
     * @param $value
     */
    public function setSectionType($value){
       $this->__set('section_type', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionTemplate(){
       return $this->__get('section_template');
    }

    /**
     * @param $value
     */
    public function setSectionTemplate($value){
       $this->__set('section_template', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionParamsText(){
       return $this->__get('section_params_text');
    }

    /**
     * @param $value
     */
    public function setSectionParamsText($value){
       $this->__set('section_params_text', $value);
    }

    /**
     * @return \Layout\Model\LayoutSectionTable
     */
    public function table(){
        return \App::table('layout.layout_section');
    }
    //END_TABLE_GENERATOR
}