<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_core_extension`
 */

namespace Core\Model;

/**
 */
use Picaso\Db\DbTable;

/**
 * Class CoreExtensionTable
 *
 * @package Core\Model
 */
class CoreExtensionTable extends DbTable
{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_core_extension`
     * @var string
     */
    protected $class =  '\Core\Model\CoreExtension';

    /**
     * @var string
     */
    protected $name =  'core_extension';

    /**
     * @var array
     */
    protected $column = array(
		'id'=>1,
		'extension_type'=>1,
		'load_order'=>1,
		'path'=>1,
		'is_active'=>1,
		'is_system'=>1,
		'namespace'=>1,
		'name'=>1,
		'title'=>1,
		'author'=>1,
		'description'=>1,
		'version'=>1,
		'created_at'=>1,
		'modified_at'=>1);

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
     * @return \Core\Model\CoreExtension
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