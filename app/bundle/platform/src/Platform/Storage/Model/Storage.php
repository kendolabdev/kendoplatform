<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_storage`
 */

namespace Platform\Storage\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\Storage
 *
 * @package Platform\Storage\Model
 */
class Storage extends Model
{
    /**
     * @return array()
     */
    public function getParams()
    {
        $params = json_decode($this->getParamsText(), true);
        $params['id'] = $this->getId();
        $params['adapter'] = $this->getAdapter();

        return $params;
    }

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('storage_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('storage_id', $value);
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
    public function getAdapter(){
       return $this->__get('adapter');
    }

    /**
     * @param $value
     */
    public function setAdapter($value){
       $this->__set('adapter', $value);
    }

    /**
     * @return null|string
     */
    public function isActive(){
       return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive(){
       return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value){
       $this->__set('is_active', $value);
    }

    /**
     * @return null|string
     */
    public function isDefault(){
       return $this->__get('is_default');
    }

    /**
     * @return null|string
     */
    public function getDefault(){
       return $this->__get('is_default');
    }

    /**
     * @param $value
     */
    public function setDefault($value){
       $this->__set('is_default', $value);
    }

    /**
     * @return null|string
     */
    public function getParamsText(){
       return $this->__get('params_text');
    }

    /**
     * @param $value
     */
    public function setParamsText($value){
       $this->__set('params_text', $value);
    }

    /**
     * @return \Platform\Storage\Model\StorageTable
     */
    public function table(){
        return app()->table('platform_storage');
    }
    //END_TABLE_GENERATOR
}