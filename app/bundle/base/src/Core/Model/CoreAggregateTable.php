<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_aggregate`
 */

namespace Core\Model;

/**
 */
use Picaso\Db\DbTable;

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
     * @see `picaso_core_aggregate`
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
     * @throws \Picaso\Db\Exception
     */
    public function findById($value){
       throw new \Picaso\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}