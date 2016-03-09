<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_photo_cover`
 */

namespace Platform\Photo\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\PhotoCover
 *
 * @package Platform\Photo\Model
 */
class PhotoCover extends Model
{
    /**
     * @param string $maker
     *
     * @return string
     */
    public function getPhoto($maker)
    {
        if ($this->getPhotoFileId() > 0) {
            if (null != ($src = app()->storageService()
                    ->getUrlByOriginAndMaker($this->getPhotoFileId(), $maker))
            ) {
                return $src;
            }
        }

        return '';
    }
    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('object_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('object_id', $value);
    }

    /**
     * @return null|string
     */
    public function getObjectId(){
       return $this->__get('object_id');
    }

    /**
     * @param $value
     */
    public function setObjectId($value){
       $this->__set('object_id', $value);
    }

    /**
     * @return null|string
     */
    public function getObjectType(){
       return $this->__get('object_type');
    }

    /**
     * @param $value
     */
    public function setObjectType($value){
       $this->__set('object_type', $value);
    }

    /**
     * @return null|string
     */
    public function getPhotoId(){
       return $this->__get('photo_id');
    }

    /**
     * @param $value
     */
    public function setPhotoId($value){
       $this->__set('photo_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPhotoFileId(){
       return $this->__get('photo_file_id');
    }

    /**
     * @param $value
     */
    public function setPhotoFileId($value){
       $this->__set('photo_file_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPositionTop(){
       return $this->__get('position_top');
    }

    /**
     * @param $value
     */
    public function setPositionTop($value){
       $this->__set('position_top', $value);
    }

    /**
     * @return null|string
     */
    public function getCreatedAt(){
       return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value){
       $this->__set('created_at', $value);
    }

    /**
     * @return \Platform\Photo\Model\PhotoCoverTable
     */
    public function table(){
        return app()->table('platform_photo_cover');
    }
    //END_TABLE_GENERATOR
}