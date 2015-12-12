<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_notification_subscribe`
 */

namespace Platform\Notification\Model;

/**
 */
use Kendo\Db\DbTable;
use Kendo\Db\Exception;

/**
 * Class Platform\NotificationSubscribeTable
 *
 * @package Platform\Notification\Model
 */
class NotificationSubscribeTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_notification_subscribe`
     * @var string
     */
    protected $class = '\Platform\Notification\Model\NotificationSubscribe';

    /**
     * @var string
     */
    protected $name = 'platform_notification_subscribe';

    /**
     * @var array
     */
    protected $column = [
        'poster_id'   => 1,
        'about_id'    => 1,
        'poster_type' => 1,
        'about_type'  => 1,
        'created_at'  => 1];

    /**
     * @var array
     */
    protected $primary = ['poster_id' => 1, 'about_id' => 1];

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