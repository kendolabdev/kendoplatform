<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_profile_value_text`
 */

namespace Core\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class CoreProfileValueTextTable
 * @package Core\Model
 */
class CoreProfileValueTextTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_core_profile_value_text`
     * @var string
     */
    protected $class =  '\Core\Model\CoreProfileValueText';

    /**
     * @var string
     */
    protected $name =  'core_profile_value_text';

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
     * @throws \Picaso\Db\Exception
     */
    public function findById($value){
       throw new \Picaso\Db\Exception('Can not find by id for '.$value);
    }

    //END_TABLE_GENERATOR
}