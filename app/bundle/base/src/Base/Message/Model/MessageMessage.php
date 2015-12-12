<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_message_message`
 */

namespace Base\Message\Model;

/**
 */
use Kendo\Model;

/**
 * Class MessageMessage
 *
 * @package Message\Model
 */
class MessageMessage extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    
    /**
     * @return null|string
     */
    public function getId(){
       return $this->__get('message_id');
    }

    /**
     * @param $value
     */
    public function setId($value){
       $this->__set('message_id', $value);
    }

    /**
     * @return null|string
     */
    public function getMessageId(){
       return $this->__get('message_id');
    }

    /**
     * @param $value
     */
    public function setMessageId($value){
       $this->__set('message_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTypeId(){
       return $this->__get('type_id');
    }

    /**
     * @param $value
     */
    public function setTypeId($value){
       $this->__set('type_id', $value);
    }

    /**
     * @return null|string
     */
    public function getReplyMessageId(){
       return $this->__get('reply_message_id');
    }

    /**
     * @param $value
     */
    public function setReplyMessageId($value){
       $this->__set('reply_message_id', $value);
    }

    /**
     * @return null|string
     */
    public function getConversationId(){
       return $this->__get('conversation_id');
    }

    /**
     * @param $value
     */
    public function setConversationId($value){
       $this->__set('conversation_id', $value);
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
    public function getContent(){
       return $this->__get('content');
    }

    /**
     * @param $value
     */
    public function setContent($value){
       $this->__set('content', $value);
    }

    /**
     * @return \Base\Message\Model\MessageMessageTable
     */
    public function table(){
        return \App::table('base_message_message');
    }
    //END_TABLE_GENERATOR
}