<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_video_playlist`
 */

namespace Video\Model;

/**
 */
use Kendo\Content\UniqueId;
use Kendo\Model;

/**
 * Class VideoPlaylist
 *
 * @package Video\Model
 */
class VideoPlaylist extends Model implements UniqueId
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('playlist_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('playlist_id', $value);
    }

    /**
     * @return null|string
     */
    public function getPlaylistId(){
       return $this->__get('playlist_id');
    }

    /**
     * @param $value
     */
    public function setPlaylistId($value){
       $this->__set('playlist_id', $value);
    }

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
    public function getUserId(){
       return $this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value){
       $this->__set('user_id', $value);
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
    public function getParentUserId(){
       return $this->__get('parent_user_id');
    }

    /**
     * @param $value
     */
    public function setParentUserId($value){
       $this->__set('parent_user_id', $value);
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
    public function getPlaylistTitle(){
       return $this->__get('playlist_title');
    }

    /**
     * @param $value
     */
    public function setPlaylistTitle($value){
       $this->__set('playlist_title', $value);
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
     * @return \Video\Model\VideoPlaylistTable
     */
    public function table(){
        return \App::table('video.video_playlist');
    }
    //END_TABLE_GENERATOR
}