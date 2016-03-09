<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_hashtag`
 */

namespace Platform\Feed\Model;

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
     * @return \Platform\Feed\Model\FeedHashtagTable
     */
    public function table(){
        return app()->table('platform_feed_hashtag');
    }
    //END_TABLE_GENERATOR
}