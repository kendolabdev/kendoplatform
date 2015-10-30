<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_follow`
 */

namespace Follow\Model;

/**
 */
use Picaso\Model;

/**
 * Class Follow
 *
 * @package Follow\Model
 */
class Follow extends Model
{

    /**
     * Notify method
     *
     * onBeforeInsertFollow
     * onBeforeDeleteFollow
     * onAfterInsertFollow
     * onAfterDeleteFollow
     *
     * @var string
     */
    protected $_signalKey = 'Follow';

    /**
     * @return \Picaso\Content\Poster
     */
    public function getPoster()
    {
        return \App::find($this->getPosterType(), $this->getPosterId());
    }

    /**
     * @return \Picaso\Content\Content
     */
    public function getParent()
    {
        return \App::find($this->getParentType(), $this->getParentId());
    }

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
    public function getParentId(){
       return $this->__get('parent_id');
    }

    /**
     * @param $value
     */
    public function setParentId($value){
       $this->__set('parent_id', $value);
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
    public function getParentType(){
       return $this->__get('parent_type');
    }

    /**
     * @param $value
     */
    public function setParentType($value){
       $this->__set('parent_type', $value);
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
     * @return \Follow\Model\FollowTable
     */
    public function table(){
        return \App::table('follow');
    }
    //END_TABLE_GENERATOR
}