<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_page_category`
 */

namespace Base\Page\Model;

/**
 */
use Kendo\Model;

/**
 * Class Category
 * @package Base\Page\Model
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
     * @return \Base\Page\Model\CategoryTable
     */
    public function table(){
        return \App::table('base_page_category');
    }
    //END_TABLE_GENERATOR
}