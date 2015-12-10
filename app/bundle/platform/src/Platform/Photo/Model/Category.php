<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_photo_category`
 */

namespace Platform\Photo\Model;

/**
 */
use Kendo\Model;

/**
 * Class Category
 * @package Platform\Photo\Model
 */
class Category extends Model{
    /**
     * @return string
     */
    public function getType()
    {
        return 'photo_photo_category';
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return ['id' => $this->getId(), 'type' => $this->getType()];
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getCategoryName();
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('category_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCategoryId(){
       return $this->__get('category_id');
    }

    /**
     * @param $value
     */
    public function setCategoryId($value){
       $this->__set('category_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCategoryName(){
       return $this->__get('category_name');
    }

    /**
     * @param $value
     */
    public function setCategoryName($value){
       $this->__set('category_name', $value);
    }

    /**
     * @return \Platform\Photo\Model\CategoryTable
     */
    public function table(){
        return \App::table('platform_photo_category');
    }
    //END_TABLE_GENERATOR
}