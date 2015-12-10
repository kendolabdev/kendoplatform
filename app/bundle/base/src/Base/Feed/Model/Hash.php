<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_feed_hash`
 */

namespace Base\Feed\Model;

/**
 */
use Kendo\Model;

/**
 * Class Hash
 * @package Base\Feed\Model
 */
class Hash extends Model{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('hash_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('hash_id', $value);
    }

    /**
     * @return null|string
     */
    public function getHashId(){
       return $this->__get('hash_id');
    }

    /**
     * @param $value
     */
    public function setHashId($value){
       $this->__set('hash_id', $value);
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
     * @return \Base\Feed\Model\HashTable
     */
    public function table(){
        return \App::table('base_feed_hash');
    }
    //END_TABLE_GENERATOR
}