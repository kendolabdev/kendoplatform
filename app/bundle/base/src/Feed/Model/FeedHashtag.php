<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_feed_hashtag`
 */

namespace Feed\Model;

/**
 */
use Kendo\Model;

/**
 * Class FeedHashtag
 *
 * @package Feed\Model
 */
class FeedHashtag extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('feed_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('feed_id', $value);
    }

    /**
     * @return null|string
     */
    public function getFeedId(){
       return $this->__get('feed_id');
    }

    /**
     * @param $value
     */
    public function setFeedId($value){
       $this->__set('feed_id', $value);
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
     * @return \Feed\Model\FeedHashtagTable
     */
    public function table(){
        return \App::table('feed.feed_hashtag');
    }
    //END_TABLE_GENERATOR
}