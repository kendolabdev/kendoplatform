<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_core_aggregate`
 */

namespace Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreAggregateTable
 *
 * @package Core\Model
 */
class CoreAggregateTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_core_aggregate`
     * @var string
     */
    protected $class =  '\Core\Model\CoreAggregate';

    /**
     * @var string
     */
    protected $name =  'core_aggregate';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1,
		'value'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1, 'name'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return null
     * @throws \Kendo\Db\Exception
     */
    public function findById($value){
       throw new \Kendo\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}