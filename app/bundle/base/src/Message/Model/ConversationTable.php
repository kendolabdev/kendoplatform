<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_message_conversation`
 */

namespace Message\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ConversationTable
 *
 * @package Message\Model
 */
class ConversationTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_message_conversation`
     * @var string
     */
    protected $class = '\Message\Model\Conversation';

    /**
     * @var string
     */
    protected $name = 'message_conversation';

    /**
     * @var array
     */
    protected $column = [
        'conversation_id' => 1,
        'title'           => 1,
        'from_id'         => 1,
        'to_id'           => 1,
        'last_message_id' => 1,
        'created_at'      => 1];

    /**
     * @var array
     */
    protected $primary = ['conversation_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'conversation_id';


    /**
     * @param  string|int $value
     *
     * @return \Message\Model\Conversation
     */
    public function findById($value)
    {
        return $this->select()
            ->where('conversation_id=?', $value)
            ->one();
    }

    /**
     * @param  array $value
     *
     * @return array
     */
    public function findByIdList($value)
    {
        return $this->select()
            ->where('conversation_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}