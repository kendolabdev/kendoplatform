<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_aggregate`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;
use Kendo\Db\Exception;

/**
 * Class AggregateTable
 *
 * @package Core\Model
 */
class AggregateTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `kendo_core_aggregate`
     * @var string
     */
    protected $class = '\Core\Model\Aggregate';

    /**
     * @var string
     */
    protected $name = 'core_aggregate';

    /**
     * @var array
     */
    protected $column = [
        'id'    => 1,
        'name'  => 1,
        'value' => 1];

    /**
     * @var array
     */
    protected $primary = ['id' => 1, 'name' => 1];

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
        throw new Exception('Can not find by id for ' . $value);
    }

    //END_TABLE_GENERATOR
}