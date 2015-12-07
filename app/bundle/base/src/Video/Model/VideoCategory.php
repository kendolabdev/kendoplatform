<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_video_category`
 */

namespace Video\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class VideoCategory
 *
 * @package Video\Model
 */
class VideoCategory extends Model implements UniqueId
{

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->getCategoryName();
    }

    /**
     * @return array
     */
    public function toTokenArray()
    {
        return [
            'id'   => $this->getId(),
            'type' => $this->getType(),
        ];
    }

    public function getType()
    {
        return 'video.video_category';
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
     * @return \Video\Model\VideoCategoryTable
     */
    public function table(){
        return \App::table('video.video_category');
    }
    //END_TABLE_GENERATOR
}