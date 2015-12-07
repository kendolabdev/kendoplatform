<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_storage_adapter`
 */

namespace Storage\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class StorageAdapterTable
 *
 * @package Storage\Model
 */
class StorageAdapterTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_storage_adapter`
     * @var string
     */
    protected $class =  '\Storage\Model\StorageAdapter';

    /**
     * @var string
     */
    protected $name =  'storage_adapter';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1,
		'admin_form'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Storage\Model\StorageAdapter
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