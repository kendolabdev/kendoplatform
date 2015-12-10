<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_mail_item`
 */

namespace Platform\Mail\Model;

/**
 */
use Kendo\Model;

/**
 * Class Item
 * @package Platform\Mail\Model
 */
class Item extends Model{
    // PUT YOUR CODE HERE

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
    public function isSent(){
       return $this->__get('is_sent');
    }

    /**
     * @return null|string
     */
    public function getSent(){
       return $this->__get('is_sent');
    }

    /**
     * @param $value
     */
    public function setSent($value){
       $this->__set('is_sent', $value);
    }

    /**
     * @return null|string
     */
    public function getPriority(){
       return $this->__get('priority');
    }

    /**
     * @param $value
     */
    public function setPriority($value){
       $this->__set('priority', $value);
    }

    /**
     * @return null|string
     */
    public function getSubject(){
       return $this->__get('subject');
    }

    /**
     * @param $value
     */
    public function setSubject($value){
       $this->__set('subject', $value);
    }

    /**
     * @return null|string
     */
    public function getBodyText(){
       return $this->__get('body_text');
    }

    /**
     * @param $value
     */
    public function setBodyText($value){
       $this->__set('body_text', $value);
    }

    /**
     * @return null|string
     */
    public function getBodyHtml(){
       return $this->__get('body_html');
    }

    /**
     * @param $value
     */
    public function setBodyHtml($value){
       $this->__set('body_html', $value);
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
     * @return \Platform\Mail\Model\ItemTable
     */
    public function table(){
        return \App::table('platform_mail_item');
    }
    //END_TABLE_GENERATOR
}