<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_setting`
 */

namespace Platform\Setting\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\SettingTable
 *
 * @package Platform\Setting\Model
 */
class SettingTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_setting`
     * @var string
     */
    protected $class = '\Platform\Setting\Model\Setting';

    /**
     * @var string
     */
    protected $name = 'platform_setting';

    /**
     * @var array
     */
    protected $column = [
        'setting_id' => 1,
        'action_id'  => 1,
        'value_text' => 1];

    /**
     * @var array
     */
    protected $primary = ['setting_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'setting_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Setting\Model\Setting
     */
    public function findById($value)
    {
        return $this->select()
            ->where('setting_id=?', $value)
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
            ->where('setting_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}