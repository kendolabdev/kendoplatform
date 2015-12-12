<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_setting_action`
 */

namespace Platform\Setting\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\SettingActionTable
 *
 * @package Platform\Setting\Model
 */
class SettingActionTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_setting_action`
     * @var string
     */
    protected $class = '\Platform\Setting\Model\SettingAction';

    /**
     * @var string
     */
    protected $name = 'platform_setting_action';

    /**
     * @var array
     */
    protected $column = [
        'action_id'    => 1,
        'module_name'  => 1,
        'action_group' => 1,
        'action_name'  => 1];

    /**
     * @var array
     */
    protected $primary = ['action_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'action_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Setting\Model\SettingAction
     */
    public function findById($value)
    {
        return $this->select()
            ->where('action_id=?', $value)
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
            ->where('action_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}