<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_storage_file`
 */

namespace Platform\Storage\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\StorageFileTable
 *
 * @package Platform\Storage\Model
 */
class StorageFileTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_storage_file`
     * @var string
     */
    protected $class =  '\Platform\Storage\Model\StorageFile';

    /**
     * @var string
     */
    protected $name =  'platform_storage_file';

    /**
     * @var array
     */
    protected $column = array(
		'file_id'=>1,
		'origin_id'=>1,
		'maker'=>1,
		'user_id'=>1,
		'storage_id'=>1,
		'size'=>1,
		'width'=>1,
		'height'=>1,
		'path'=>1,
		'main_type'=>1,
		'created_at'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'file_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'file_id';

    
    /**
     * @param  string|int $value
     * @return \Platform\Storage\Model\StorageFile
     */
    public function findById($value){
       return $this->select()
           ->where('file_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('file_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}