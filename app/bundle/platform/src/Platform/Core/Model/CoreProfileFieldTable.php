<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_profile_field`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreProfileFieldTable
 *
 * @package Core\Model
 */
class CoreProfileFieldTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_core_profile_field`
     * @var string
     */
    protected $class = '\Platform\Core\Model\CoreProfileField';

    /**
     * @var string
     */
    protected $name = 'platform_core_profile_field';

    /**
     * @var array
     */
    protected $column = [
        'field_id'     => 1,
        'content_type' => 1,
        'field_name'   => 1,
        'plugin_id'    => 1,
        'is_required'  => 1,
        'is_multiple'  => 1,
        'data_type'    => 1];

    /**
     * @var array
     */
    protected $primary = ['field_id' => 1];

    /**
     * @var string
     */
    protected $identity = 'field_id';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Core\Model\CoreProfileField
     */
    public function findById($value)
    {
        return $this->select()
            ->where('field_id=?', $value)
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
            ->where('field_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}