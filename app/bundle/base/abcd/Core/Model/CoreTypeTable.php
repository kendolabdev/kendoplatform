<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_core_type`
 */

namespace Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreTypeTable
 *
 * @package Core\Model
 */
class CoreTypeTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_core_type`
     * @var string
     */
    protected $class =  '\Core\Model\CoreType';

    /**
     * @var string
     */
    protected $name =  'core_type';

    /**
     * @var array
     */
    protected $column = array(
		'type_id'=>1,
		'name'=>1,
		'is_poster'=>1,
		'module_name'=>1,
		'has_attribute_catalog'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'type_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Core\Model\CoreType
     */
    public function findById($value){
       return $this->select()
           ->where('type_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('type_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}