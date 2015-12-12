<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_message_recipient`
 */

namespace Platform\Message\Model;

/**
 */
use Kendo\Db\DbTable;
use Kendo\Db\Exception;

/**
 * Class MessageRecipientTable
 *
 * @package Message\Model
 */
class MessageRecipientTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_message_recipient`
     * @var string
     */
    protected $class = '\Platform\Message\Model\MessageRecipient';

    /**
     * @var string
     */
    protected $name = 'platform_message_recipient';

    /**
     * @var array
     */
    protected $column = [
        'recipient_id'       => 1,
        'conversation_id'    => 1,
        'is_active'          => 1,
        'recipient_type'     => 1,
        'history_message_id' => 1,
        'unread_count'       => 1,
        'last_message_id'    => 1,
        'modified_at'        => 1];

    /**
     * @var array
     */
    protected $primary = ['recipient_id' => 1, 'conversation_id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return null
     * @throws \Kendo\Db\Exception
     */
    public function findById($value)
    {
        throw new \Kendo\Db\Exception('Can not find by id for ' . $value);
    }

    //END_TABLE_GENERATOR
}