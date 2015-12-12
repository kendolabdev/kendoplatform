<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_value`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class ValueTable
 *
 * @package Core\Model
 */
class ValueTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `kendo_core_value`
     * @var string
     */
    protected $class = '\Core\Model\Value';

    /**
     * @var string
     */
    protected $name = 'core_value';

    /**
     * @var array
     */
    protected $column = [
        'parent_id'   => 1,
        'parent_type' => 1,
        'values_text' => 1];

    /**
     * @var array
     */
    protected $primary = ['parent_id' => 1];

    /**
     * @var string
     */
    protected $identity = '';


    /**
     * @param  string|int $value
     *
     * @return \Platform\Core\Model\Value
     */
    public function findById($value)
    {
        return $this->select()
            ->where('parent_id=?', $value)
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
            ->where('parent_id IN ?', $value)
            ->all();
    }

    //END_TABLE_GENERATOR
}