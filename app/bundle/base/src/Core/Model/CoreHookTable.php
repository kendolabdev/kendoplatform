<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_hook`
 */

namespace Core\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class CoreHookTable
 *
 * @package Core\Model
 */
class CoreHookTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_core_hook`
     * @var string
     */
    protected $class =  '\Core\Model\CoreHook';

    /**
     * @var string
     */
    protected $name =  'core_hook';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'event_name'=>1,
		'service_name'=>1,
		'load_order'=>1,
		'module_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = 'id';

    
    /**
     * @param  string|int $value
     * @return \Core\Model\CoreHook
     */
    public function findById($value){
       return $this->select()
           ->where('id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}