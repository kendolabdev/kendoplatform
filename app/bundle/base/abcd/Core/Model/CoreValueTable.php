<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_core_value`
 */

namespace Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreValueTable
 *
 * @package Core\Model
 */
class CoreValueTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_core_value`
     * @var string
     */
    protected $class =  '\Core\Model\CoreValue';

    /**
     * @var string
     */
    protected $name =  'core_value';

    /**
     * @var array
     */
    protected $column = array(
		'parent_id'=>1,
		'parent_type'=>1,
		'values_text'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'parent_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Core\Model\CoreValue
     */
    public function findById($value){
       return $this->select()
           ->where('parent_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('parent_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}