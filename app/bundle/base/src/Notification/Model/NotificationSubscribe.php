<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_notification_subscribe`
 */

namespace Notification\Model;

/**
 */
use Picaso\Model;

/**
 * Class NotificationSubscribe
 *
 * @package Notification\Model
 */
class NotificationSubscribe extends Model
{
    /**
     * @return \Picaso\Content\Content
     */
    public function getAbout()
    {
        return \App::find($this->getAboutType(), $this->getAboutId());
    }

    /**
     * @return \Picaso\Content\Poster
     */
    public function getPoster()
    {
        return \App::find($this->getPosterType(), $this->getPosterId());
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
    public function getAboutId(){
       return $this->__get('about_id');
    }

    /**
     * @param $value
     */
    public function setAboutId($value){
       $this->__set('about_id', $value);
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
    public function getAboutType(){
       return $this->__get('about_type');
    }

    /**
     * @param $value
     */
    public function setAboutType($value){
       $this->__set('about_type', $value);
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
     * @return \Notification\Model\NotificationSubscribeTable
     */
    public function table(){
        return \App::table('notification.notification_subscribe');
    }
    //END_TABLE_GENERATOR
}