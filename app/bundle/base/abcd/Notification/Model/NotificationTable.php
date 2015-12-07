<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_notification`
 */

namespace Notification\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class NotificationTable
 *
 * @package Notification\Model
 */
class NotificationTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_notification`
     * @var string
     */
    protected $class =  '\Notification\Model\Notification';

    /**
     * @var string
     */
    protected $name =  'notification';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'type_id'=>1,
		'poster_id'=>1,
		'user_id'=>1,
		'parent_id'=>1,
		'parent_user_id'=>1,
		'poster_type'=>1,
		'parent_type'=>1,
		'about_id'=>1,
		'about_type'=>1,
		'created_at'=>1,
		'read'=>1,
		'mitigated'=>1,
		'params'=>1,
		'atom_type'=>1,
		'atom_id'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = 'id';

    
    /**
     * @param  string|int $value
     * @return \Notification\Model\Notification
     */
    public function findById($value){
       return $this->select()
           ->where('id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}