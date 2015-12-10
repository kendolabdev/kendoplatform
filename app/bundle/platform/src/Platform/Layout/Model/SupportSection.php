<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_layout_support_section`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class SupportSection
 * @package Platform\Layout\Model
 */
class SupportSection extends Model{
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getSupportSectionName();
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('support_section_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('support_section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSupportSectionId(){
       return $this->__get('support_section_id');
    }

    /**
     * @param $value
     */
    public function setSupportSectionId($value){
       $this->__set('support_section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSupportSectionName(){
       return $this->__get('support_section_name');
    }

    /**
     * @param $value
     */
    public function setSupportSectionName($value){
       $this->__set('support_section_name', $value);
    }

    /**
     * @return null|string
     */
    public function getSupportSectionOrder(){
       return $this->__get('support_section_order');
    }

    /**
     * @param $value
     */
    public function setSupportSectionOrder($value){
       $this->__set('support_section_order', $value);
    }

    /**
     * @return null|string
     */
    public function getSupportSectionType(){
       return $this->__get('support_section_type');
    }

    /**
     * @param $value
     */
    public function setSupportSectionType($value){
       $this->__set('support_section_type', $value);
    }

    /**
     * @return \Platform\Layout\Model\SupportSectionTable
     */
    public function table(){
        return \App::table('platform_layout_support_section');
    }
    //END_TABLE_GENERATOR
}