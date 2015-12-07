<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_feed_hash`
 */

namespace Feed\Model;

/**
 */
use Kendo\Model;

/**
 * Class FeedHash
 *
 * @package Feed\Model
 */
class FeedHash extends Model
{
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
     * @return \Feed\Model\FeedHashTable
     */
    public function table(){
        return \App::table('feed.feed_hash');
    }
    //END_TABLE_GENERATOR
}