<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_core_profile_value_string`
 */

namespace Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreProfileValueStringTable
 * @package Core\Model
 */
class CoreProfileValueStringTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_core_profile_value_string`
     * @var string
     */
    protected $class =  '\Core\Model\CoreProfileValueString';

    /**
     * @var string
     */
    protected $name =  'core_profile_value_string';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1,
		'sort_order'=>1,
		'value'=>1,
		'privacy_type'=>1,
		'privacy_value'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1, 'name'=>1, 'sort_order'=>1);

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