<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_photo_category`
 */

namespace Platform\Photo\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class Platform\PhotoCategory
 *
 * @package Platform\Photo\Model
 */
class PhotoCategory extends Model implements UniqueId
{

    /**
     * @return string
     */
    public function getType()
    {
        return 'platform_photo_category';
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
     * @return \Platform\Photo\Model\PhotoCategoryTable
     */
    public function table(){
        return app()->table('platform_photo_category');
    }
    //END_TABLE_GENERATOR
}