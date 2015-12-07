<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_message_message`
 */

namespace Message\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class MessageTable
 *
 * @package Message\Model
 */
class MessageTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_message_message`
     * @var string
     */
    protected $class = '\Message\Model\Message';

    /**
     * @var string
     */
    protected $name = 'message_message';

    /**
     * @var array
     */
    protected $column = [
        'message_id'       => 1,
        'type_id'          => 1,
        'reply_message_id' => 1,
        'conversation_id'  => 1,
        'poster_id'        => 1,
        'poster_type'      => 1,
        'created_at'       => 1,
        'subject'          => 1,
        'content'          => 1];

    /**
     * @var array
     */
    protected $primary = ['message_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'message_id';


    /**
     * @param  string|int $value
     *
     * @return \Message\Model\Message
     */
    public function findById($value)
    {
        return $this->select()
            ->where('message_id=?', $value)
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
            ->where('message_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}