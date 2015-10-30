<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_event_category`
 */

namespace Event\Model;

/**
 */
use Picaso\Content\UniqueId;
use Picaso\Model;

/**
 * Class EventCategory
 *
 * @package Event\Model
 */
class EventCategory extends Model implements UniqueId
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'event.event_category';
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
     * @return \Event\Model\EventCategoryTable
     */
    public function table(){
        return \App::table('event.event_category');
    }
    //END_TABLE_GENERATOR
}