<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_attribute_section_map`
 */

namespace Attribute\Model;

/**
 */
use Picaso\Model;

/**
 * Class AttributeSectionMap
 * @package Attribute\Model
 */
class AttributeSectionMap extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('map_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('map_id', $value);
    }

    /**
     * @return null|string
     */
    public function getMapId(){
       return $this->__get('map_id');
    }

    /**
     * @param $value
     */
    public function setMapId($value){
       $this->__set('map_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCatalogId(){
       return $this->__get('catalog_id');
    }

    /**
     * @param $value
     */
    public function setCatalogId($value){
       $this->__set('catalog_id', $value);
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
    public function getSortOrder(){
       return $this->__get('sort_order');
    }

    /**
     * @param $value
     */
    public function setSortOrder($value){
       $this->__set('sort_order', $value);
    }

    /**
     * @return \Attribute\Model\AttributeSectionMapTable
     */
    public function table(){
        return \App::table('attribute.attribute_section_map');
    }
    //END_TABLE_GENERATOR
}