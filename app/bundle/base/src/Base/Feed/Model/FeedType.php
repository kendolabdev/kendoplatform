<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_feed_feed_type`
 */

namespace Base\Feed\Model;

/**
 */
use Kendo\Model;

/**
 * Class FeedType
 *
 * @package Feed\Model
 */
class FeedType extends Model
{
    /**
     * @param $prefix
     *
     * @return string
     */
    public function toText($prefix)
    {
        return \App::text($prefix . $this->getFeedType());
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
    public function getFeedType(){
       return $this->__get('feed_type');
    }

    /**
     * @param $value
     */
    public function setFeedType($value){
       $this->__set('feed_type', $value);
    }

    /**
     * @return null|string
     */
    public function getModuleName(){
       return $this->__get('module_name');
    }

    /**
     * @param $value
     */
    public function setModuleName($value){
       $this->__set('module_name', $value);
    }

    /**
     * @return null|string
     */
    public function getShowOnPublic(){
       return $this->__get('show_on_public');
    }

    /**
     * @param $value
     */
    public function setShowOnPublic($value){
       $this->__set('show_on_public', $value);
    }

    /**
     * @return null|string
     */
    public function getShowOnParent(){
       return $this->__get('show_on_parent');
    }

    /**
     * @param $value
     */
    public function setShowOnParent($value){
       $this->__set('show_on_parent', $value);
    }

    /**
     * @return null|string
     */
    public function getShowOnPoster(){
       return $this->__get('show_on_poster');
    }

    /**
     * @param $value
     */
    public function setShowOnPoster($value){
       $this->__set('show_on_poster', $value);
    }

    /**
     * @return null|string
     */
    public function getShowOnMain(){
       return $this->__get('show_on_main');
    }

    /**
     * @param $value
     */
    public function setShowOnMain($value){
       $this->__set('show_on_main', $value);
    }

    /**
     * @return null|string
     */
    public function getCanShare(){
       return $this->__get('can_share');
    }

    /**
     * @param $value
     */
    public function setCanShare($value){
       $this->__set('can_share', $value);
    }

    /**
     * @return null|string
     */
    public function getCanLike(){
       return $this->__get('can_like');
    }

    /**
     * @param $value
     */
    public function setCanLike($value){
       $this->__set('can_like', $value);
    }

    /**
     * @return null|string
     */
    public function getCanComment(){
       return $this->__get('can_comment');
    }

    /**
     * @param $value
     */
    public function setCanComment($value){
       $this->__set('can_comment', $value);
    }

    /**
     * @return null|string
     */
    public function getShowOnTagged(){
       return $this->__get('show_on_tagged');
    }

    /**
     * @param $value
     */
    public function setShowOnTagged($value){
       $this->__set('show_on_tagged', $value);
    }

    /**
     * @return \Base\Feed\Model\FeedTypeTable
     */
    public function table(){
        return \App::table('base_feed_type');
    }
    //END_TABLE_GENERATOR
}