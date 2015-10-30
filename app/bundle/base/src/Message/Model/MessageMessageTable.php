<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_message_message`
 */

namespace Message\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class MessageMessageTable
 *
 * @package Message\Model
 */
class MessageMessageTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_message_message`
     * @var string
     */
    protected $class =  '\Message\Model\MessageMessage';

    /**
     * @var string
     */
    protected $name =  'message_message';

    /**
     * @var array
     */
    protected $column = array(
		'message_id'=>1,
		'type_id'=>1,
		'reply_message_id'=>1,
		'conversation_id'=>1,
		'poster_id'=>1,
		'poster_type'=>1,
		'created_at'=>1,
		'subject'=>1,
		'content'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'message_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'message_id';

    
    /**
     * @param  string|int $value
     * @return \Message\Model\MessageMessage
     */
    public function findById($value){
       return $this->select()
           ->where('message_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('message_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}