<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_storage`
 */

namespace Storage\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class StorageTable
 *
 * @package Storage\Model
 */
class StorageTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_storage`
     * @var string
     */
    protected $class =  '\Storage\Model\Storage';

    /**
     * @var string
     */
    protected $name =  'storage';

    /**
     * @var array
     */
    protected $column = array(
		'storage_id'=>1,
		'adapter'=>1,
		'is_active'=>1,
		'is_default'=>1,
		'params_text'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'storage_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'storage_id';

    
    /**
     * @param  string|int $value
     * @return \Storage\Model\Storage
     */
    public function findById($value){
       return $this->select()
           ->where('storage_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('storage_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}