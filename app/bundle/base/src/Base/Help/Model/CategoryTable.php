<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_help_category`
 */

namespace Base\Help\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CategoryTable
 * @package Base\Help\Model
 */
class CategoryTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_help_category`
     * @var string
     */
    protected $class =  '\Base\Help\Model\Category';

    /**
     * @var string
     */
    protected $name =  'base_help_category';

    /**
     * @var array
     */
    protected $column = array(
		'category_id'=>1,
		'category_active'=>1,
		'category_sort_order'=>1,
		'category_name'=>1,
		'category_slug'=>1);

    /**
     * @var array
     */
    protected $primary = array( 'category_id'=>1);

    /**
     * @var string
     */
    protected $identity = 'category_id';

    
    /**
     * @param  string|int $value
     * @return \Base\Help\Model\Category
     */
    public function findById($value){
       return $this->select()
           ->where('category_id=?', $value)
           ->one();
    }

    /**
     * @param  array $value
     * @return array
     */
    public function findByIdList($value){
       return $this->select()
           ->where('category_id IN ?', $value)
           ->all();
    }

    //END_TABLE_GENERATOR
}