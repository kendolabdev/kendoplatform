<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_help_category`
 */

namespace Base\Help\Model;

/**
 */
use Kendo\Model;

/**
 * Class Category
 * @package Base\Help\Model
 */
class Category extends Model{
    // PUT YOUR CODE HERE

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
    public function getCategoryActive(){
       return $this->__get('category_active');
    }

    /**
     * @param $value
     */
    public function setCategoryActive($value){
       $this->__set('category_active', $value);
    }

    /**
     * @return null|string
     */
    public function getCategorySortOrder(){
       return $this->__get('category_sort_order');
    }

    /**
     * @param $value
     */
    public function setCategorySortOrder($value){
       $this->__set('category_sort_order', $value);
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
     * @return null|string
     */
    public function getCategorySlug(){
       return $this->__get('category_slug');
    }

    /**
     * @param $value
     */
    public function setCategorySlug($value){
       $this->__set('category_slug', $value);
    }

    /**
     * @return \Base\Help\Model\CategoryTable
     */
    public function table(){
        return \App::table('base_help_category');
    }
    //END_TABLE_GENERATOR
}