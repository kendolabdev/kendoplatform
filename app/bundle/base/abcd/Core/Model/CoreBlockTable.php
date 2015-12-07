<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_core_block`
 */

namespace Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreBlockTable
 *
 * @package Core\Model
 */
class CoreBlockTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_core_block`
     * @var string
     */
    protected $class =  '\Core\Model\CoreBlock';

    /**
     * @var string
     */
    protected $name =  'core_block';

    /**
     * @var array
     */
    protected $column = array(
		'poster_id'=>1,
		'object_id'=>1,
		'poster_type'=>1,
		'object_type'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'poster_id'=>1, 'object_id'=>1);

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