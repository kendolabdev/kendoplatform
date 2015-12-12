<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_video_playlist_video`
 */

namespace Platform\Video\Model;

/**
 */
use Kendo\Model;

/**
 * Class VideoPlaylistVideo
 *
 * @package Video\Model
 */
class VideoPlaylistVideo extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
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
    public function getVideoId(){
       return $this->__get('video_id');
    }

    /**
     * @param $value
     */
    public function setVideoId($value){
       $this->__set('video_id', $value);
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
     * @return \Platform\Video\Model\VideoPlaylistVideoTable
     */
    public function table(){
        return \App::table('platform_video_playlist_video');
    }
    //END_TABLE_GENERATOR
}