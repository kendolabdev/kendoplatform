<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_log`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CoreLogTable
 *
 * @package Core\Model
 */
class CoreLogTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_core_log`
     * @var string
     */
    protected $class =  '\Platform\Core\Model\CoreLog';

    /**
     * @var string
     */
    protected $name =  'platform_core_log';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'level'=>1,
		'uid'=>1,
		'message'=>1,
		'created_at'=>1);

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
     * @return \Platform\Core\Model\CoreLog
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