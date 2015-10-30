<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_message_recipient`
 */

namespace Message\Model;

/**
 */
use Picaso\Model;

/**
 * Class Recipient
 *
 * @package Message\Model
 */
class Recipient extends Model
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getRecipientId()
    {
        return $this->__get('recipient_id');
    }

    /**
     * @param $value
     */
    public function setRecipientId($value)
    {
        $this->__set('recipient_id', $value);
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
    public function isActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @return null|string
     */
    public function getActive()
    {
        return $this->__get('is_active');
    }

    /**
     * @param $value
     */
    public function setActive($value)
    {
        $this->__set('is_active', $value);
    }

    /**
     * @return null|string
     */
    public function getRecipientType()
    {
        return $this->__get('recipient_type');
    }

    /**
     * @param $value
     */
    public function setRecipientType($value)
    {
        $this->__set('recipient_type', $value);
    }

    /**
     * @return null|string
     */
    public function getHistoryMessageId()
    {
        return $this->__get('history_message_id');
    }

    /**
     * @param $value
     */
    public function setHistoryMessageId($value)
    {
        $this->__set('history_message_id', $value);
    }

    /**
     * @return null|string
     */
    public function getUnreadCount()
    {
        return $this->__get('unread_count');
    }

    /**
     * @param $value
     */
    public function setUnreadCount($value)
    {
        $this->__set('unread_count', $value);
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
    public function getModifiedAt()
    {
        return $this->__get('modified_at');
    }

    /**
     * @param $value
     */
    public function setModifiedAt($value)
    {
        $this->__set('modified_at', $value);
    }

    /**
     * @return \Message\Model\RecipientTable
     */
    public function table()
    {
        return \App::table('message.recipient');
    }
    //END_TABLE_GENERATOR
}