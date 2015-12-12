<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_blog_category`
 */

namespace Platform\Blog\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class Base\BlogCategory
 *
 * @package Base\Blog\Model
 */
class BlogCategory extends Model implements UniqueId
{
    /**
     * @return string
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
     * @return \Platform\Blog\Model\BlogCategoryTable
     */
    public function table(){
        return \App::table('platform_blog_category');
    }
    //END_TABLE_GENERATOR
}