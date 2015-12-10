<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_platform_core_type`
 */

namespace Platform\Core\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class TypeTable
 * @package Platform\Core\Model
 */
class TypeTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_platform_core_type`
     * @var string
     */
    protected $class =  '\Platform\Core\Model\Type';

    /**
     * @var string
     */
    protected $name =  'platform_core_type';

    /**
     * @var array
     */
    protected $column = array(
		'type_id'=>1,
		'name'=>1,
		'is_poster'=>1,
		'module_name'=>1,
		'has_attribute_catalog'=>1,
		'table_name'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'type_id'=>1);

    /**
     * @var string
     */
    protected $identity = '';

    
    /**
     * @param  string|int $value
     * @return \Platform\Core\Model\Type
     */
    public function findById($value){
       return $this->select()
           ->where('type_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('type_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}