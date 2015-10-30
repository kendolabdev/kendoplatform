<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_blog_category`
 */

namespace Blog\Model;

/**
 */
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class BlogCategory
 *
 * @package Blog\Model
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
     * @return \Blog\Model\BlogCategoryTable
     */
    public function table(){
        return \App::table('blog.blog_category');
    }
    //END_TABLE_GENERATOR
}