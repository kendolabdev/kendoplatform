<?php
/**
 * Generate by CodeGenerator\DbTable for table `picaso_base_report_category`
 */

namespace Base\Report\Model;

/**
 */
use Kendo\Db\DbTable;

/**
 * Class CategoryTable
 * @package Base\Report\Model
 */
class CategoryTable extends DbTable{
    // PUT YOUR CODE HERE

    //START_TABLE_GENERATOR

    /**
     * @see `picaso_base_report_category`
     * @var string
     */
    protected $class =  '\Base\Report\Model\Category';

    /**
     * @var string
     */
    protected $name =  'base_report_category';

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
     * @return \Base\Report\Model\Category
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