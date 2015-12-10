<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_core_uid_generator`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class UidGeneratorTable
 *
 * @package Core\Model
 */
class UidGeneratorTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_core_uid_generator`
     * @var string
     */
    protected $class =  '\Platform\Core\Model\UidGenerator';

    /**
     * @var string
     */
    protected $name =  'platform_core_uid_generator';

    /**
     * @var array
     */
    protected $column = array(
		'uid'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'uid'=>1);

    /**
     * @var string
     */
    protected $identity = 'uid';

    
    /**
     * @param  string|int $value
     * @return \Platform\Core\Model\UidGenerator
     */
    public function findById($value){
       return $this->select()
           ->where('uid=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('uid IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}