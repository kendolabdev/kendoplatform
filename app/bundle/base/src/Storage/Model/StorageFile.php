<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_storage_file`
 */

namespace Storage\Model;

/**
 */
use Picaso\Model;

/**
 * Class StorageFile
 *
 * @package Storage\Model
 */
class StorageFile extends Model
{

    /**
     * @return string
     */
    public function getUrl()
    {
        return \App::storageService()
            ->getStorage($this->getStorageId())
            ->getUrl($this->getPath());
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('file_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('file_id', $value);
    }

    /**
     * @return null|string
     */
    public function getFileId(){
       return $this->__get('file_id');
    }

    /**
     * @param $value
     */
    public function setFileId($value){
       $this->__set('file_id', $value);
    }

    /**
     * @return null|string
     */
    public function getOriginId(){
       return $this->__get('origin_id');
    }

    /**
     * @param $value
     */
    public function setOriginId($value){
       $this->__set('origin_id', $value);
    }

    /**
     * @return null|string
     */
    public function getMaker(){
       return $this->__get('maker');
    }

    /**
     * @param $value
     */
    public function setMaker($value){
       $this->__set('maker', $value);
    }

    /**
     * @return null|string
     */
    public function getUserId(){
       return $this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value){
       $this->__set('user_id', $value);
    }

    /**
     * @return null|string
     */
    public function getStorageId(){
       return $this->__get('storage_id');
    }

    /**
     * @param $value
     */
    public function setStorageId($value){
       $this->__set('storage_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSize(){
       return $this->__get('size');
    }

    /**
     * @param $value
     */
    public function setSize($value){
       $this->__set('size', $value);
    }

    /**
     * @return null|string
     */
    public function getWidth(){
       return $this->__get('width');
    }

    /**
     * @param $value
     */
    public function setWidth($value){
       $this->__set('width', $value);
    }

    /**
     * @return null|string
     */
    public function getHeight(){
       return $this->__get('height');
    }

    /**
     * @param $value
     */
    public function setHeight($value){
       $this->__set('height', $value);
    }

    /**
     * @return null|string
     */
    public function getPath(){
       return $this->__get('path');
    }

    /**
     * @param $value
     */
    public function setPath($value){
       $this->__set('path', $value);
    }

    /**
     * @return null|string
     */
    public function getMainType(){
       return $this->__get('main_type');
    }

    /**
     * @param $value
     */
    public function setMainType($value){
       $this->__set('main_type', $value);
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
     * @return \Storage\Model\StorageFileTable
     */
    public function table(){
        return \App::table('storage.storage_file');
    }
    //END_TABLE_GENERATOR
}