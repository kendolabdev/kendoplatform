<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_core_service`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreServiceTable
 * @package Platform\Core\Model
 */
class CoreServiceTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_core_service`
     * @var string
     */
    protected $class =  '\Platform\Core\Model\CoreService';

    /**
     * @var string
     */
    protected $name =  'platform_core_service';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1,
		'class_name'=>1,
		'package_name'=>1);

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
     * @return \Platform\Core\Model\CoreService
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