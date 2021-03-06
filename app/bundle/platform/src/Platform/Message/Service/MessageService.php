<?php

namespace Platform\Message\Service;

use Kendo\Kernel\KernelService;
use Platform\Message\Model\Conversation;
use Platform\Message\Model\Message;
use Platform\Message\Model\Recipient;
use Kendo\Content\PosterInterface;

/**
 * Class MessageService
 *
 * @package Message\Service
 */
class MessageService extends KernelService
{

    /**
     * 2 members message
     */
    const TYPE_MESSAGE = 'message';


    /**
     * group message converstation
     */
    const TYPE_GROUP_MESSAGE = 'group';


    /**
     * @param $convId
     *
     * @return \Platform\Message\Model\Conversation
     */
    public function findConversation($convId)
    {
        return app()->table('platform_message_conversation')
            ->findById($convId);
    }

    /**
     * @param string $msgId
     *
     * @return \Platform\Message\Model\Message
     */
    public function findMessage($msgId)
    {
        return app()->table('platform_message')
            ->findById($msgId);
    }

    /**
     * Find recipient entry
     *
     * @param $convId
     * @param $recipientId
     *
     * @return \Platform\Message\Model\Recipient
     */
    public function findRecipient($convId, $recipientId)
    {
        return app()->table('platform_message_recipient')
            ->select()
            ->where('conversation_id=?', (string)$convId)
            ->where('recipient_id=?', (string)$recipientId)
            ->one();
    }

    /**
     * @param $convId
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function selectRecipients($convId)
    {
        return app()->table('platform_message_recipient')
            ->select()
            ->where('conversation_id=?', (string)$convId);
    }

    /**
     * @param $convId
     *
     * @return array
     */
    public function findRecipients($convId)
    {
        return $this->selectRecipients($convId)->all();
    }

    /**
     * @param $convId
     *
     * @return array
     */
    public function findActiveRecipients($convId)
    {
        return $this->selectRecipients($convId)->where('is_active=?', 1)->all();
    }

    /**
     * @param PosterInterface $parent
     *
     * @return int
     */
    public function getUnreadConversationCount(PosterInterface $parent = null)
    {
        if (null == $parent) {
            $parent = app()->auth()->getViewer();
        }

        if (!$parent instanceof PosterInterface) return 0;

        $select = app()->table('platform_message_recipient')
            ->select()
            ->where('recipient_id=?', $parent->getId())
            ->where('is_active=?', 1)
            ->where('unread_count <> ?', 0);

        return $select->count();
    }

    /**
     * @param PosterInterface $from
     * @param PosterInterface $to
     *
     * @return \Platform\Message\Model\Conversation
     */
    public function findMessageConversation(PosterInterface $from, PosterInterface $to)
    {
        $fromId = $from->getId();
        $toId = $to->getId();

        $minId = $fromId < $toId ? $fromId : $toId;
        $maxId = $fromId < $toId ? $toId : $fromId;

        return app()->table('platform_message_conversation')
            ->select()
            ->where('from_id=?', $minId)
            ->where('to_id=?', $maxId)
            ->one();
    }

    /**
     * @param PosterInterface $from
     * @param PosterInterface $to
     *
     * @return \Platform\Message\Model\Conversation
     */
    public function findMessageConversationThenCreateIfNotFound(PosterInterface $from, PosterInterface $to)
    {
        $conv = $this->findMessageConversation($from, $to);

        if (!$conv) {
            $conv = $this->createMessageConversation($from, $to);
        }

        return $conv;
    }


    /**
     * Check poster is in recipient list of specific message
     *
     * @param $recipientId
     * @param $msgId
     *
     * @return bool
     */
    public function hasRecipient($recipientId, $msgId)
    {
        return null != app()->table('platform_message_recipient')
            ->select()
            ->where('recipient_id=?', (string)$recipientId)
            ->where('message_id=?', (string)$msgId)
            ->field('recipient_id');
    }

    /**
     * @param string          $convId
     * @param PosterInterface $poster
     *
     * @return bool
     */
    public function clearHistory($convId, PosterInterface $poster)
    {
        $conv = $this->findConversation($convId);

        if (!$conv instanceof Conversation) {
            return false;
        }

        $rec = $this->findRecipient($convId, $poster->getId());

        if (!$rec instanceof Recipient) {
            return false;
        }

        $rec->setHistoryMessageId($conv->getLastMessageId() + 1);

        $rec->setModifiedAt(KENDO_DATE_TIME);

        $rec->save();

        return true;
    }

    /**
     * @param PosterInterface $poster
     * @param array           $recipients
     * @param string          $title
     *
     * @return \Platform\Message\Model\Conversation
     * @throws \InvalidArgumentException
     */
    public function createGroupMessageConversation(PosterInterface $poster, $recipients, $title = '')
    {
        // create conversation first

        $conv = new Conversation([
            'title'      => (string)$title,
            'created_at' => KENDO_DATE_TIME,
        ]);

        $conv->save();

        if (!is_array($recipients) || empty($recipients)) {
            throw new \InvalidArgumentException("Invalid arguments [recipients]");
        }

        $recipients[] = $poster;

        foreach ($recipients as $item) {
            if (!$item instanceof PosterInterface) {
                throw new \InvalidArgumentException("Invalid arguments [recipients]");
            }

            $rec = new Recipient([
                'conversation_id' => $conv->getId(),
                'recipient_id'    => $item->getId(),
                'recipient_type'  => $item->getType(),
                'modified_at'     => KENDO_DATE_TIME,
            ]);

            $rec->save();
        }

        return $conv;
    }

    /**
     * Create a chat conversation between $recipients and $poster.
     *
     * @param PosterInterface $from
     * @param PosterInterface $to
     *
     * @return \Platform\Message\Model\Conversation
     * @throws \InvalidArgumentException
     */
    public function createMessageConversation(PosterInterface $from, PosterInterface $to)
    {

        // create conversation first
        $minId = $from->getId() < $to->getId() ? $from->getId() : $to->getId();
        $maxId = $from->getId() < $to->getId() ? $to->getId() : $from->getId();

        $conv = new Conversation([
            'title'      => '',
            'from_id'    => $minId,
            'to_id'      => $maxId,
            'created_at' => KENDO_DATE_TIME,
        ]);

        $conv->save();

        foreach ([$from, $to] as $item) {
            if (!$item instanceof PosterInterface) {
                continue;
            }
            $rec = new Recipient([
                'conversation_id' => $conv->getId(),
                'recipient_id'    => $item->getId(),
                'recipient_type'  => $item->getType(),
                'modified_at'     => KENDO_DATE_TIME,
            ]);
            $rec->save();
        }

        return $conv;
    }


    /**
     * Add recipients to already existing chat groups
     *
     * @param string          $convId
     * @param PosterInterface $poster
     * @param array           $recipients
     *
     * @return bool  return true if no exception
     * @throws \InvalidArgumentException
     *
     * TODO check if recipient blocked poster
     */
    public function addRecipientsToChatGroupConversation($convId, PosterInterface $poster, $recipients)
    {
        if (!is_array($recipients) || empty($recipients)) {
            throw new \InvalidArgumentException("Invalid argument [recipients]");
        }

        if (!$this->findRecipient($convId, $poster->getId())) {
            throw new \InvalidArgumentException("You don't have permission to add recipient to converstaion does not contain you");
        }

        $conv = $this->findConversation($convId);

        if (!$conv instanceof Conversation) {
            throw new \InvalidArgumentException("Invalid arugments [convId]");
        }

        foreach ($recipients as $item) {
            if (!$item instanceof PosterInterface) {
                throw new \InvalidArgumentException("Invalid argument [recipients]");
            }

            $rec = $this->findRecipient($convId, $item->getId());

            if (null == $rec) {
                $rec = new Recipient([
                    'conversation_id'    => $convId,
                    'recipient_id'       => $item->getId(),
                    'recipient_type'     => $item->getType(),
                    'history_message_id' => $conv->getLastMessageId(),
                    'is_active'          => 1,
                    'unread_count'       => 0,
                    'modified_at'        => KENDO_DATE_TIME,
                ]);
                $rec->save();
            }
        }
    }

    /**
     * A member want to leave a chat group. if member leave a 2 member chat conversation it should throws exceptions.
     *
     * @param string          $convId
     * @param PosterInterface $poster
     *
     * @return bool  Return true if member leave chat group successful.
     */
    public function leaveGroupConversation($convId, PosterInterface $poster)
    {
        $conv = $this->findConversation($convId);

        if (!$conv instanceof Conversation) {
            return false;
        }

        $rec = $this->findRecipient($convId, $poster->getId());

        if (!$rec instanceof Recipient) {
            return false;
        }

        $rec->setActive(false);

        $rec->save();

        return true;
    }


    /**
     * Reply an existing message.
     *
     * @param string          $replyMsgId
     * @param PosterInterface $poster
     * @param string          $subject
     * @param string          $content
     *
     * @return \Platform\Message\Model\Message
     * @throws \InvalidArgumentException
     */
    public function replyMessage($replyMsgId, PosterInterface $poster, $subject, $content)
    {
        $replyMsg = $this->findMessage($replyMsgId);

        if (!$replyMsg instanceof Message) {
            throw new \InvalidArgumentException("Invalid arguments [replyMsgId]");
        }

        $conv = $this->findConversation($replyMsg->getConversationId());

        if (!$conv instanceof Conversation) {
            throw new \InvalidArgumentException("Invalid argument [replyMsgId]");
        }

        $msg = new Message([
            'conversation_id'  => $conv->getId(),
            'reply_message_id' => $replyMsg->getId(),
            'poster_id'        => $poster->getId(),
            'poster_type'      => $poster->getType(),
            'type_id'          => self::TYPE_MESSAGE,
            'subject'          => (string)$subject,
            'content'          => (string)$content,
            'created_at'       => KENDO_DATE_TIME,
        ]);

        $msg->save();

        $this->sendMessageToRecipients($conv, $msg);

        return $msg;
    }

    /**
     * @param Conversation $conv
     * @param Message      $msg
     *
     * @return bool
     */
    private function sendMessageToRecipients(Conversation $conv, Message $msg)
    {
        $conv->setLastMessageId($msg->getId());

        $conv->setTitle($msg->getSubject());

        foreach ($this->findActiveRecipients($conv->getId()) as $recipient) {
            if (!$recipient instanceof Recipient) continue;

            /**
             * message poster
             */
            if ($recipient->getRecipientId() == $msg->getPosterId()) {
                $recipient->setLastMessageId($msg->getId());
                $recipient->setModifiedAt(KENDO_DATE_TIME);
            } else {
                $unreadCound = $recipient->getUnreadCount() + 1;
                $recipient->setUnreadCount($unreadCound);
                $recipient->setLastMessageId($msg->getId());
            }

            $recipient->setModifiedAt(KENDO_DATE_TIME);
            $recipient->save();
        }

        $conv->save();
    }


    /**
     * Create a new message.
     * Do not use this method when a member reply an existing message.
     *
     * @param PosterInterface $poster
     * @param array           $recipients
     * @param string          $subject
     * @param string          $content
     *
     * @return \Platform\Message\Model\Message
     * @throws \InvalidArgumentException
     *
     */
    public function addMessage(PosterInterface $poster, $recipients, $subject, $content)
    {

        $typeId = null;

        if (count($recipients) == 1) {
            $typeId = self::TYPE_MESSAGE;
            $conv = $this->findMessageConversationThenCreateIfNotFound($poster, $recipients[0]);
        } else {
            $typeId = self::TYPE_GROUP_MESSAGE;
            $conv = $this->createGroupMessageConversation($poster, $recipients, $subject);
        }

        $conv->save();

        $msg = new Message([
            'conversation_id'  => $conv->getId(),
            'type_id'          => $typeId,
            'reply_message_id' => 0,
            'subject'          => (string)$subject,
            'content'          => (string)$content,
            'poster_id'        => $poster->getId(),
            'poster_type'      => $poster->getType(),
            'created_at'       => KENDO_DATE_TIME,
        ]);

        $msg->save();

        $this->sendMessageToRecipients($conv, $msg);

        return $msg;
    }


    /**
     * @param PosterInterface $poster
     *
     * @return \Kendo\Db\SqlSelect
     */
    public function getConversationIdForPoster(PosterInterface $poster)
    {
        return app()->table('platform_message_recipient')
            ->select()
            ->where('recipient_id=?', $poster->getId());
    }

    /**
     * @param string $convId
     *
     * @return array
     */
    public function getOtherRecipients($convId)
    {
        $select = app()->table('platform_message_recipient')
            ->select()
            ->where('conversation_id=?', $convId);

        if (app()->auth()->getId() > 0) {
            $select->where('recipient_id<>?', app()->auth()->getId());
        }

        $pairs = $select->toPairs('recipient_id', 'recipient_type');

        $types = [];

        foreach ($pairs as $id => $type) {
            $types[ $type ][] = $id;
        }

        $response = [];

        foreach ($types as $type => $idList) {
            foreach (app()->table($type)->findByIdList($idList) as $item) {
                $response[] = $item;
            }
        }

        return $response;
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadMessagePaging($query = [], $page = 1, $limit = 12)
    {
        $parentId = !empty($query['parentId']) ? $query['parentId'] : app()->auth()->getId();

        $messageIdList = app()->table('platform_message_recipient')
            ->select()
            ->where('recipient_id=?', $parentId)
            ->where('is_active=?', 1)
            ->where('unread_count <> ?', 0)
            ->fields('last_message_id');

        /**
         * Prevent sql error
         */
        if (empty($messageIdList)) {
            $messageIdList[] = 0;
        }

        /**
         * Select message
         */

        return app()->table('platform_message')
            ->select()
            ->where('message_id IN ?', $messageIdList)
            ->paging($page, $limit);

    }
}