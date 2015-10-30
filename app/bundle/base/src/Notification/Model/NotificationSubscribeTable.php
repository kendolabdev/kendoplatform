<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_notification_subscribe`
 */

namespace Notification\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class NotificationSubscribeTable
 *
 * @package Notification\Model
 */
class NotificationSubscribeTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_notification_subscribe`
     * @var string
     */
    protected $class =  '\Notification\Model\NotificationSubscribe';

    /**
     * @var string
     */
    protected $name =  'notification_subscribe';

    /**
     * @var array
     */
    protected $column = array(
		'poster_id'=>1,
		'about_id'=>1,
		'poster_type'=>1,
		'about_type'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'poster_id'=>1, 'about_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return null
     * @throws \Picaso\Db\Exception
     */
    public function findById($value){
       throw new \Picaso\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}