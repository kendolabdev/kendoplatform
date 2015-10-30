<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_notification_type`
 */

namespace Notification\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class NotificationTypeTable
 *
 * @package Notification\Model
 */
class NotificationTypeTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_notification_type`
     * @var string
     */
    protected $class =  '\Notification\Model\NotificationType';

    /**
     * @var string
     */
    protected $name =  'notification_type';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'handler'=>1,
		'is_active'=>1,
		'is_push'=>1,
		'is_mail'=>1,
		'is_sms'=>1,
		'module_name'=>1,
		'notification_group'=>1,
		'user_edit'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Notification\Model\NotificationType
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