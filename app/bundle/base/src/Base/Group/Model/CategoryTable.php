<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_group_category`
 */

namespace Base\Group\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CategoryTable
 * @package Base\Group\Model
 */
class CategoryTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_group_category`
     * @var string
     */
    protected $class =  '\Base\Group\Model\Category';

    /**
     * @var string
     */
    protected $name =  'base_group_category';

    /**
     * @var array
     */
    protected $column = array(
		'category_id'=>1,
		'category_name'=>1);

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
     * @return \Base\Group\Model\Category
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