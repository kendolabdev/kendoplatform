<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_page_category`
 */

namespace Page\Model;

/**
 */
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class PageCategory
 *
 * @package Page\Model
 */
class PageCategory extends Model implements UniqueId
{

    /**
     * @return string
     */
    public function getType()
    {
        return 'page.page_category';
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
     * @return \Page\Model\PageCategoryTable
     */
    public function table(){
        return \App::table('page.page_category');
    }
    //END_TABLE_GENERATOR
}