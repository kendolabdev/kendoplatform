<?php
/**
 * Generate by CodeGenerator\DbTable for table `Kendo_storage_file_tmp`
 */

namespace Storage\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class StorageFileTmpTable
 *
 * @package Storage\Model
 */
class StorageFileTmpTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `Kendo_storage_file_tmp`
     * @var string
     */
    protected $class =  '\Storage\Model\StorageFileTmp';

    /**
     * @var string
     */
    protected $name =  'storage_file_tmp';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'name'=>1,
		'type'=>1,
		'size'=>1,
		'path'=>1,
		'storage_id'=>1,
		'created_at'=>1);

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
     * @return \Storage\Model\StorageFileTmp
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