<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_storage_adapter`
 */

namespace Platform\Storage\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class Platform\StorageAdapterTable
 *
 * @package Platform\Storage\Model
 */
class StorageAdapterTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_storage_adapter`
     * @var string
     */
    protected $class =  '\Platform\Storage\Model\StorageAdapter';

    /**
     * @var string
     */
    protected $name =  'platform_storage_adapter';

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
     * @return \Platform\Storage\Model\StorageAdapter
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