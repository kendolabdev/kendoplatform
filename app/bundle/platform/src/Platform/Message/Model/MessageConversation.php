<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_message_conversation`
 */

namespace Platform\Message\Model;

/**
 */
use Kendo\Model;

/**
 * Class MessageConversation
 *
 * @package Message\Model
 */
class MessageConversation extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('conversation_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('conversation_id', $value);
    }

    /**
     * @return null|string
     */
    public function getConversationId()
    {
        return $this->__get('conversation_id');
    }

    /**
     * @param $value
     */
    public function setConversationId($value)
    {
        $this->__set('conversation_id', $value);
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->__get('title');
    }

    /**
     * @param $value
     */
    public function setTitle($value)
    {
        $this->__set('title', $value);
    }

    /**
     * @return null|string
     */
    public function getFromId()
    {
        return $this->__get('from_id');
    }

    /**
     * @param $value
     */
    public function setFromId($value)
    {
        $this->__set('from_id', $value);
    }

    /**
     * @return null|string
     */
    public function getToId()
    {
        return $this->__get('to_id');
    }

    /**
     * @param $value
     */
    public function setToId($value)
    {
        $this->__set('to_id', $value);
    }

    /**
     * @return null|string
     */
    public function getLastMessageId()
    {
        return $this->__get('last_message_id');
    }

    /**
     * @param $value
     */
    public function setLastMessageId($value)
    {
        $this->__set('last_message_id', $value);
    }

    /**
     * @return null|string
     */
    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

    /**
     * @return \Platform\Message\Model\MessageConversationTable
     */
    public function table()
    {
        return \App::table('platform_message_conversation');
    }
    //END_TABLE_GENERATOR
}