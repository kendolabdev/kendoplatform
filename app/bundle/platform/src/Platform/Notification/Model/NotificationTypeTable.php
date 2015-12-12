<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_notification_type`
 */

namespace Platform\Notification\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\NotificationTypeTable
 *
 * @package Platform\Notification\Model
 */
class NotificationTypeTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_notification_type`
     * @var string
     */
    protected $class = '\Platform\Notification\Model\NotificationType';

    /**
     * @var string
     */
    protected $name = 'platform_notification_type';

    /**
     * @var array
     */
    protected $column = [
        'id'                 => 1,
        'handler'            => 1,
        'is_active'          => 1,
        'is_push'            => 1,
        'is_mail'            => 1,
        'is_sms'             => 1,
        'module_name'        => 1,
        'notification_group' => 1,
        'user_edit'          => 1];

    /**
     * @var array
     */
    protected $primary = ['id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Notification\Model\NotificationType
     */
    public function findById($value)
    {
        return $this->select()
            ->where('id=?', $value)
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
            ->where('id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}