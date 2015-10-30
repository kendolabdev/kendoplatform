<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_log`
 */

namespace Core\Model;

/**
 */
use Picaso\Model;

/**
 * Class CoreLog
 *
 * @package Core\Model
 */
class CoreLog extends Model
{
    // PUT YOUR CODE HERE

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
    public function getLevel(){
       return $this->__get('level');
    }

    /**
     * @param $value
     */
    public function setLevel($value){
       $this->__set('level', $value);
    }

    /**
     * @return null|string
     */
    public function getUid(){
       return $this->__get('uid');
    }

    /**
     * @param $value
     */
    public function setUid($value){
       $this->__set('uid', $value);
    }

    /**
     * @return null|string
     */
    public function getMessage(){
       return $this->__get('message');
    }

    /**
     * @param $value
     */
    public function setMessage($value){
       $this->__set('message', $value);
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
     * @return \Core\Model\CoreLogTable
     */
    public function table(){
        return \App::table('core.core_log');
    }
    //END_TABLE_GENERATOR
}