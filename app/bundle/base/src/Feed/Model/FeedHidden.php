<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_feed_hidden`
 */

namespace Feed\Model;

/**
 */
use Picaso\Model;

/**
 * Class FeedHidden
 *
 * @package Feed\Model
 */
class FeedHidden extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getViewerId(){
       return $this->__get('viewer_id');
    }

    /**
     * @param $value
     */
    public function setViewerId($value){
       $this->__set('viewer_id', $value);
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
     * @return \Feed\Model\FeedHiddenTable
     */
    public function table(){
        return \App::table('feed.feed_hidden');
    }
    //END_TABLE_GENERATOR
}