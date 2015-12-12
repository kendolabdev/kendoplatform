<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_message_conversation`
 */

namespace Base\Message\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class MessageConversationTable
 *
 * @package Message\Model
 */
class MessageConversationTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_message_conversation`
     * @var string
     */
    protected $class =  '\Base\Message\Model\MessageConversation';

    /**
     * @var string
     */
    protected $name =  'base_message_conversation';

    /**
     * @var array
     */
    protected $column = array(
		'conversation_id'=>1,
		'title'=>1,
		'from_id'=>1,
		'to_id'=>1,
		'last_message_id'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'conversation_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'conversation_id';

    
    /**
     * @param  string|int $value
     * @return \Base\Message\Model\MessageConversation
     */
    public function findById($value){
       return $this->select()
           ->where('conversation_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('conversation_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}