<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_storage_file_tmp`
 */

namespace Storage\Model;

/**
 */
use Picaso\Model;

/**
 * Class StorageFileTmp
 *
 * @package Storage\Model
 */
class StorageFileTmp extends Model
{
    /**
     * create id temporary
     */
    public function _beforeInsert()
    {
        if (null == $this->getId()) {
            $this->setId(uniqid('tmp'));
        }
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return \App::storage()->getStorage($this->getStorageId())->getUrl($this->getPath());
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('id', $value);
    }

    /**
     * @return null|string
     */
    public function getName(){
       return $this->__get('name');
    }

    /**
     * @param $value
     */
    public function setName($value){
       $this->__set('name', $value);
    }

    /**
     * @return null|string
     */
    public function getType(){
       return $this->__get('type');
    }

    /**
     * @param $value
     */
    public function setType($value){
       $this->__set('type', $value);
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
     * @return \Storage\Model\StorageFileTmpTable
     */
    public function table(){
        return \App::table('storage.storage_file_tmp');
    }
    //END_TABLE_GENERATOR
}