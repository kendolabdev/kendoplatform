<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_storage_file_tmp`
 */

namespace Platform\Storage\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\StorageFileTmpTable
 *
 * @package Platform\Storage\Model
 */
class StorageFileTmpTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_storage_file_tmp`
     * @var string
     */
    protected $class =  '\Platform\Storage\Model\StorageFileTmp';

    /**
     * @var string
     */
    protected $name =  'platform_storage_file_tmp';

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
     * @return \Platform\Storage\Model\StorageFileTmp
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