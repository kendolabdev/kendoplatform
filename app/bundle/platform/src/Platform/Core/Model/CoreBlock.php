<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_block`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Model;

/**
 * Class CoreBlock
 *
 * @package Core\Model
 */
class CoreBlock extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getPosterId(){
       return $this->__get('poster_id');
    }

    /**
     * @param $value
     */
    public function setPosterId($value){
       $this->__set('poster_id', $value);
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
    public function getPosterType(){
       return $this->__get('poster_type');
    }

    /**
     * @param $value
     */
    public function setPosterType($value){
       $this->__set('poster_type', $value);
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
     * @return \Platform\Core\Model\CoreBlockTable
     */
    public function table(){
        return app()->table('platform_core_block');
    }
    //END_TABLE_GENERATOR
}